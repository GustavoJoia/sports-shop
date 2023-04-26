<?php
    require_once '../model/Venda.php';
    require_once '../model/Cliente.php';
    require_once '../model/Conexao.php';

    class DaoVenda{

        public static function cadastrar($venda){
            $conexao = Conexao::conectar();

            $insert = "INSERT INTO tbVenda(dataVenda, valorTotalVenda, statusVenda, codCliente)
                             VALUES(?,?,?,?)";
            
            $prepare = $conexao->prepare($insert);
            
            $prepare->bindValue(1, $venda->getData());
            $prepare->bindValue(2, $venda->getValorTotal());
            $prepare->bindValue(3, $venda->getStatus());
            $prepare->bindValue(4, $venda->getCliente()->getId());

            $prepare->execute();
        }

        public static function consultarId($venda){
            $conexao = Conexao::conectar();

            $select = "SELECT MAX(codVenda) AS maior FROM tbVenda";
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();

            foreach ($lista as $venda)
                return $venda['maior'];   
        }

        public static function contar(){
            $conexao = Conexao::conectar();

            $select = "SELECT COUNT(codVenda) AS qtde FROM tbVenda";
            $resultado = $conexao->query($select);
            $num = $resultado->fetchAll();
            foreach ($num as $n)
                return $n['qtde'];   
        }

        public static function contarVendas(){

            $conexao = Conexao::conectar();
            $select = 'SELECT COUNT(codVenda) AS qtde FROM tbVenda
                       WHERE statusVenda = 6';
            $resultado = $conexao->query($select);

            $lista = $resultado->fetchAll();
            foreach($lista as $num){
                return $num['qtde'];
            }

        }

        public static function contarClienteVenda(){
            $conexao = Conexao::conectar();

            $select = "SELECT codCliente, COUNT(codVenda) AS qtde FROM tbVenda 
                            GROUP BY codCliente ORDER BY qtde DESC";
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();

            foreach ($lista as $cliente)
                return $cliente['idcliente'];   
        }

        public static function contarReceita(){
            $conexao = Conexao::conectar();
            $select = 'SELECT SUM(valorTotalVenda) AS receita FROM tbVenda
                       WHERE statusVenda = 6';
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();

            foreach($lista as $receita){
                return $receita['receita'];
            }

        }

        public static function atualizarStatus($venda){
            $conexao = Conexao::conectar();

            $update = 'UPDATE tbVenda SET statusVenda = ?, dataVenda = ? WHERE codVenda = ?';

            $prepare = $conexao->prepare($update);
            $prepare->bindValue(1, $venda->getStatus());
            $prepare->bindValue(2, $venda->getData());
            $prepare->bindValue(3, $venda->getId());
            $prepare->execute();

        }

        public static function contarPedido(){
            $conexao = Conexao::conectar();

            $select = "SELECT COUNT(codVenda) AS qtde FROM tbVenda 
                       WHERE statusVenda = 1 OR statusVenda = 2 OR statusVenda = 5";
            $resultado = $conexao->query($select);
            $num = $resultado->fetchAll();

            foreach ($num as $n)
                return $n['qtde'];   
        }

        public static function listar(){
            $conexao = Conexao::conectar();

            $select = 'SELECT tbVenda.codVenda, dataVenda, valorTotalVenda, statusVenda, codCliente, SUM(qtdeItemVenda) AS itensVenda FROM tbVenda
                       INNER JOIN tbItemVenda ON tbItemVenda.codVenda = tbVenda.codVenda
                       GROUP BY tbVenda.codVenda, valorTotalVenda, statusVenda, codCliente
                       ORDER BY statusVenda ASC';
            $resultado = $conexao->query($select);

            $lista = $resultado->fetchAll();
            return $lista;
        }

        public static function listarFinalizadas($cliente){
            $conexao = Conexao::conectar();
            $select = "SELECT * FROM vwVendasFinalizadas
                    WHERE codCliente = ?";
            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $cliente->getId());
            $prepare->execute();
            if ($prepare->rowCount() > 0) {
                while($lista = $prepare->fetch(PDO::FETCH_ASSOC)){
                    $valores[] = $lista;
                }
            }
            return $valores;
        }

        public static function listarAndamento($cliente){
            $conexao = Conexao::conectar();
            $select = "SELECT * FROM vwVendasAndamento
                    WHERE codCliente = ?";
            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $cliente->getId());
            $prepare->execute();
            $valores = array();
            if ($prepare->rowCount() > 0) {
                while($lista = $prepare->fetch(PDO::FETCH_ASSOC)){
                    $valores[] = $lista;
                }
            }
            return $valores;
        }

        public static function listarCanceladas($cliente){
            $conexao = Conexao::conectar();
            $select = "SELECT * FROM vwVendasCanceladas
                    WHERE codCliente = ?";
            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $cliente->getId());
            $prepare->execute();
            if ($prepare->rowCount() > 0) {
                while($lista = $prepare->fetch(PDO::FETCH_ASSOC)){
                    $valores[] = $lista;
                }
            }
            return $valores;
        }

    }
?>