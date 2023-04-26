<?php
    require_once '../model/Produto.php';
    require_once '../model/Conexao.php';

    class DaoProduto{

        public static function cadastrar($produto){
            $conexao = Conexao::conectar();

            $insert = "INSERT INTO tbProduto(nomeProduto, estoqueProduto, marcaProduto, precoProduto, codCategoria, codSubcategoria)
                            VALUES(?,?,?,?,?,?)";
            
            $prepareStatement = $conexao->prepare($insert);
            
            $prepareStatement->bindValue(1, $produto->getNome());
		    $prepareStatement->bindValue(2, $produto->getEstoque());
            $prepareStatement->bindValue(3, $produto->getMarca());
            $prepareStatement->bindValue(4, $produto->getPreco());
            $prepareStatement->bindValue(5, $produto->getCategoria()->getId());
            $prepareStatement->bindValue(6, $produto->getSubcategoria()->getId());

            $prepareStatement->execute();
            return true;
        }

        public static function consultarId($produto){
            $conexao = Conexao::conectar();
            $select = "SELECT codProduto FROM tbProduto WHERE nomeproduto LIKE ?";

            $prepareStatement = $conexao->prepare($select);

            $prepareStatement->bindValue(1, $produto->getNome());

            $prepareStatement->execute();

            $lista = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            $id = $lista['codProduto'];
            return $id;
        }

        public static function atualizarFoto($produto){
            $conexao = Conexao::conectar();

            $update = "UPDATE tbProduto
                            SET fotoProduto = ?
                            WHERE codProduto = ?";
            
            $prepareStatement = $conexao->prepare($update);
            
            $prepareStatement->bindValue(1, $produto->getFoto());
            $prepareStatement->bindValue(2, $produto->getId());

            if($prepareStatement->execute()){
            echo "salvou";
            }else{
            echo "não salvou";
            }

        }

        public static function listar($variacao){
            $conexao = Conexao::conectar();

            if($variacao == 0){
                $select = "SELECT codProduto, nomeProduto, estoqueProduto, marcaProduto, precoProduto, fotoProduto, nomeCategoria, nomeSubcategoria FROM tbProduto
                            INNER JOIN tbCategoria on tbProduto.codCategoria = tbCategoria.codCategoria
                            INNER JOIN tbSubcategoria on tbProduto.codSubcategoria = tbSubcategoria.codSubcategoria";
                $resultado = $conexao->query($select);
                $lista = $resultado->fetchAll();
                return $lista;
            } else if($variacao == 1) {
                $select = 'SELECT codProduto, nomeProduto, estoqueProduto, marcaProduto, precoProduto, fotoProduto, nomeCategoria, nomeSubcategoria FROM tbProduto
                INNER JOIN tbCategoria on tbProduto.codCategoria = tbCategoria.codCategoria
                INNER JOIN tbSubcategoria on tbProduto.codSubcategoria = tbSubcategoria.codSubcategoria
                ORDER BY codProduto DESC LIMIT 6';
                $resultado = $conexao->query($select);
                $lista = $resultado->fetchAll();
                return $lista;
            }
        }

        public static function listarEspecifico($produto){
            $conexao = Conexao::conectar();
            $select = 'SELECT codProduto, nomeProduto, estoqueProduto, marcaProduto, precoProduto, fotoProduto, tbProduto.codCategoria, tbProduto.codSubCategoria, tbCategoria.nomeCategoria, tbSubcategoria.nomeSubCategoria FROM tbProduto
                       INNER JOIN tbCategoria ON tbProduto.codCategoria = tbCategoria.codCategoria
                       INNER JOIN tbSubcategoria ON tbProduto.codSubCategoria = tbSubcategoria.codSubCategoria
                       WHERE codProduto = ?';
            $prepareStatement = $conexao->prepare($select);
            
            $prepareStatement->bindValue(1, $produto->getId());
            $prepareStatement->execute();
            $lista = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            return $lista;
        }

        public static function listarViaItemVenda($venda){
            $conexao = Conexao::conectar();
            $select = 'SELECT qtdeItemVenda AS qtde, subTotalItemVenda AS subTotal, tbProduto.nomeProduto, tbProduto.codProduto, tbProduto.fotoProduto, tbProduto.estoqueProduto FROM tbItemVenda 
                       INNER JOIN tbProduto ON tbProduto.codProduto = tbItemVenda.codProduto
                       WHERE tbItemVenda.codVenda = ?';
            $prepareStatement = $conexao->prepare($select);
            
            $prepareStatement->bindValue(1, $venda->getId());
            $prepareStatement->execute();
            while($lista = $prepareStatement->fetch(PDO::FETCH_ASSOC)){
                $dados[] = $lista;
            }
            return $dados;
        }

        public static function listarEditar($produto){
            $conexao = Conexao::conectar();
            $select = 'SELECT nomeProduto, estoqueProduto, marcaProduto, precoProduto, fotoProduto, nomeCategoria, nomeSubCategoria FROM tbProduto
                       INNER JOIN tbCategoria ON tbCategoria.codCategoria = tbProduto.codCategoria
                       INNER JOIN tbSubcategoria ON tbSubcategoria.codSubCategoria = tbProduto.codSubCategoria
                       WHERE codProduto = ?';
            $prepareStatement = $conexao->prepare($select);
            
            $prepareStatement->bindValue(1, $produto->getId());
            $prepareStatement->execute();
            $lista = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            return $lista;
        }

        public static function listarSimilares($produto){

            $conexao = Conexao::conectar();
            $select = 'SELECT codProduto, nomeProduto, marcaProduto, precoProduto, fotoProduto FROM tbProduto
                       WHERE codCategoria = ? AND codSubCategoria = ? AND codProduto AND codProduto NOT LIKE ?
                       LIMIT 5';
            $prepare = $conexao->prepare($select);

            $prepare->bindValue(1, $produto->getCategoria()->getId());
            $prepare->bindValue(2, $produto->getSubcategoria()->getId());
            $prepare->bindValue(3, $produto->getId());
            $prepare->execute();
            if ($prepare->rowCount() > 0) {
                while($lista = $prepare->fetch(PDO::FETCH_ASSOC)){
                    $valores[] = $lista;
                }
                
            }

            return $valores;
            

        }

        public static function atualizar($produto){
            $conexao = Conexao::conectar();
            $update = 'UPDATE tbProduto
                       SET nomeProduto = ?, estoqueProduto = ?, marcaProduto = ?, precoProduto = ?, fotoProduto = ?, codCategoria = ?, codSubCategoria = ?
                       WHERE codProduto = ?';
            $prepareStatement = $conexao->prepare($update);

            $prepareStatement->bindValue(1, $produto->getNome());
            $prepareStatement->bindValue(2, $produto->getEstoque());
            $prepareStatement->bindValue(3, $produto->getMarca());
            $prepareStatement->bindValue(4, $produto->getPreco());
            $prepareStatement->bindValue(5, $produto->getFoto());
            $prepareStatement->bindValue(6, $produto->getCategoria()->getId());
            $prepareStatement->bindValue(7, $produto->getSubcategoria()->getId());
            $prepareStatement->bindValue(8, $produto->getId());

            $prepareStatement->execute();
        }

        public static function excluir($produto){
            $conexao = Conexao::conectar();
            $select = 'SELECT fotoProduto FROM tbProduto WHERE codProduto = ?';
            $delete = "DELETE FROM tbProduto WHERE codProduto = ?";

            $prepareStatement1 = $conexao->prepare($select);
            $prepareStatement1->bindValue(1, $produto->getId());
            $prepareStatement1->execute(); 
            $lista = $prepareStatement1->fetch(PDO::FETCH_ASSOC);
            $foto = $lista['fotoProduto'];
            unlink('../'.$foto);

            $prepareStatement2 = $conexao->prepare($delete);
            $prepareStatement2->bindValue(1, $produto->getId());
            $prepareStatement2->execute();
        }

        public static function contarProdutos(){

            $conexao = Conexao::conectar();
            $select = 'SELECT COUNT(codProduto) AS qtde FROM tbProduto';
            $resultado = $conexao->query($select);

            $lista = $resultado->fetchAll();
            foreach($lista as $num){
                return $num['qtde'];
            }

        }

        public static function contarEstoque($produto){
            $conexao = Conexao::conectar();
            $select = 'SELECT estoqueProduto FROM tbProduto WHERE codProduto = ?';
            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $produto->getId());
            $prepare->execute();
            $lista = $prepare->fetch(PDO::FETCH_ASSOC);
            foreach($lista as $estoque){
                return $estoque['estoqueProduto'];
            }
        }

        public static function atualizarEstoque($produto){
            $conexao = Conexao::conectar();
            $update = 'UPDATE tbProduto SET estoqueProduto = ? WHERE codProduto = ?';
            $prepare = $conexao->prepare($update);
            $prepare->bindValue(1, $produto->getEstoque());
            $prepare->bindValue(2, $produto->getId());

            $prepare->execute();
        }
    }
?>