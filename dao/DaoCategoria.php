<?php
    require_once '../model/Categoria.php';
    require_once '../model/Conexao.php';

    class DaoCategoria{

        public static function cadastrar($categoria){
            $conexao = Conexao::conectar();

            $insert = "INSERT INTO tbCategoria(nomeCategoria, descCategoria)
                            VALUES(?,?)";
            
            $prepareStatement = $conexao->prepare($insert);
            
            $prepareStatement->bindValue(1, $categoria->getNome());
            $prepareStatement->bindValue(2, $categoria->getDescricao());

            $prepareStatement->execute();
        }

        public static function consultarId($categoria){
            $conexao = Conexao::conectar();
            $select = "SELECT codCategoria FROM tbCategoria WHERE nomeCategoria LIKE ? AND descCategoria LIKE ?";

            $prepareStatement = $conexao->prepare($select);

            $prepareStatement->bindValue(1, $categoria->getNome());
            $prepareStatement->bindValue(2, $categoria->getDescricao());

            $prepareStatement->execute();

            $lista = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            $id = $lista['codCategoria'];
            return $id;
        }

        public static function atualizarFoto($categoria){
            $conexao = Conexao::conectar();

            $update = "UPDATE tbCategoria
                            SET fotoCategoria = ?
                            WHERE codCategoria = ?";
            
            $prepareStatement = $conexao->prepare($update);
            
            $prepareStatement->bindValue(1, $categoria->getFoto());
            $prepareStatement->bindValue(2, $categoria->getId());

            if($prepareStatement->execute()){
            echo "salvou";
            }else{
            echo "não salvou";
            }

        }

        public static function listar($variacao){
            $conexao = Conexao::conectar();

            if($variacao == 0){
                $select = "SELECT codCategoria, fotoCategoria, nomeCategoria, descCategoria FROM tbCategoria";
                $resultado = $conexao->query($select);
                $lista = $resultado->fetchAll();
                return $lista;
            } else if($variacao == 1){
                $select = 'SELECT codCategoria, fotoCategoria, nomeCategoria, descCategoria FROM tbCategoria
                           ORDER BY codCategoria ASC LIMIT 2';
                $resultado = $conexao->query($select);
                $lista = $resultado->fetchAll();
                return $lista;        
            }
        }

        public static function listarEspecifico($categoria){
            $conexao = Conexao::conectar();
            $select = 'SELECT nomeCategoria, descCategoria, fotoCategoria FROM tbCategoria
                       WHERE codCategoria = ?';
            $prepareStatement = $conexao->prepare($select);
            
            $prepareStatement->bindValue(1, $categoria->getId());
            $prepareStatement->execute();
            $lista = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            return $lista;
        }

        public static function atualizar($categoria){
            $conexao = Conexao::conectar();

            $update = 'UPDATE tbCategoria SET nomeCategoria = ?, descCategoria = ?, fotoCategoria = ? WHERE codCategoria = ?';

            $prepareStatement = $conexao->prepare($update);
            $prepareStatement->bindValue(1, $categoria->getNome());
            $prepareStatement->bindValue(2, $categoria->getDescricao());
            $prepareStatement->bindValue(3, $categoria->getFoto());
            $prepareStatement->bindValue(4, $categoria->getId());

            $prepareStatement->execute();
        }

        public static function excluir($categoria){
            $conexao = Conexao::conectar();
            $select = 'SELECT fotoCategoria FROM tbCategoria WHERE codCategoria = ?';
            $delete = 'DELETE FROM tbCategoria WHERE codCategoria = ?';

            $prepareStatement1 = $conexao->prepare($select);
            $prepareStatement1->bindValue(1, $categoria->getId());
            $prepareStatement1->execute(); 
            $lista = $prepareStatement1->fetch(PDO::FETCH_ASSOC);
            $foto = $lista['fotoCategoria'];
            unlink('../'.$foto);

            $prepareStatement2 = $conexao->prepare($delete);
            $prepareStatement2->bindValue(1, $categoria->getId());
            $prepareStatement2->execute();

        }
    }
?>