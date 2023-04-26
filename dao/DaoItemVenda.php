<?php

    require_once '../model/Produto.php';
    require_once '../model/Venda.php';
    require_once('../model/ItemVenda.php');
    require_once('../model/Conexao.php');

    class DaoItemVenda{

        public static function cadastrar(ItemVenda $item, Venda $venda){
            $conexao = Conexao::conectar();

            $insert = "INSERT INTO tbItemVenda(codVenda, codProduto, qtdeItemVenda, subTotalItemVenda)
                                VALUES(?,?,?,?)";

            $prepare = $conexao->prepare($insert);

            $prepare->bindValue(1, $venda->getId());
            $prepare->bindValue(2, $item->getProduto()->getId());
            $prepare->bindValue(3, $item->getQtde());
            $prepare->bindValue(4, $item->getSubTotal());

            $prepare->execute();
        }

        public static function listar(){
            $conexao = Conexao::conectar();

            $select = "SELECT codVenda, codProduto, qtdeItemVenda, subTotalTtemVenda FROM tbItemVenda";
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();
            
            return $lista;   
        }

        public static function listarItemVenda(Venda $venda){
            $conexao = Conexao::conectar();

            $select = 'SELECT qtdeItemVenda AS qtde, subTotalItemVenda AS subTotal, tbProduto.nomeProduto, tbProduto.codProduto FROM tbItemVenda 
                       INNER JOIN tbProduto ON tbProduto.codProduto = tbItemVenda.codProduto
                       WHERE codVenda = ?';
            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $venda->getId());
            $prepare->execute();
            if($prepare->rowCount() > 0){
                while($lista = $prepare->fetch(PDO::FETCH_ASSOC)){
                    $valores[] = $lista;
                }
            }
            
            return $valores;
        }

        public static function buscarProdutos($venda){
            $conexao = Conexao::conectar();
            $select = 'SELECT codProduto FROM tbItemVenda WHERE codVenda = ?';
            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $venda->getId());
            $prepare->execute();
            
            if($prepare->rowCount() > 0){
                while($lista = $prepare->Fetch(PDO::FETCH_ASSOC)){
                    $ids[] = $lista;
                }
            }

            return $ids;

        }

        public static function contarProdutoVenda(){
            $conexao = Conexao::conectar();

            $select = "SELECT codProduto, COUNT(codItemVenda) AS qtde FROM tbItemVenda 
                       GROUP BY codProduto ORDER BY qtde DESC";
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();

            foreach ($lista as $cliente)
                return $cliente['idproduto'];   
        }

        public static function maisVendido(){
            $conexao = Conexao::conectar();
            $select = 'SELECT tbItemVenda.codProduto,nomeProduto, estoqueProduto, marcaProduto, precoProduto, fotoProduto, tbProduto.codCategoria, tbProduto.codSubCategoria, tbCategoria.nomeCategoria, tbSubcategoria.nomeSubCategoria, SUM(qtdeItemVenda) as Quantidade FROM tbItemVenda 
                       INNER JOIN tbProduto ON tbItemVenda.codProduto = tbProduto.codProduto
                       INNER JOIN tbCategoria ON tbProduto.codCategoria = tbCategoria.codCategoria
                       INNER JOIN tbSubcategoria ON tbProduto.codSubCategoria = tbSubcategoria.codSubCategoria
                       GROUP BY tbItemVenda.codProduto, nomeProduto, estoqueProduto, marcaProduto, precoProduto, fotoProduto, tbProduto.codCategoria, tbProduto.codSubCategoria, tbCategoria.nomeCategoria, tbSubcategoria.nomeSubCategoria
                       ORDER BY Quantidade DESC LIMIT 5';
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();

            return $lista;
            
        }

    }

?>