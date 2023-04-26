<?php
    require_once '../model/Subcategoria.php';
    require_once '../model/Conexao.php';

    class DaoSubcategoria{

        public static function cadastrar($subcategoria){
            $conexao = Conexao::conectar();

            $insert = "INSERT INTO tbSubcategoria(nomeSubCategoria, descSubCategoria)
                            VALUES(?,?)";
            
            $prepareStatement = $conexao->prepare($insert);
            
            $prepareStatement->bindValue(1, $subcategoria->getNome());
            $prepareStatement->bindValue(2, $subcategoria->getDescricao());

            $prepareStatement->execute();
        }

        public static function listar(){
            $conexao = Conexao::conectar();

            $select = "SELECT codSubCategoria, nomeSubCategoria, descSubCategoria, fotoSubCategoria FROM tbSubcategoria";
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        public static function consultarId($subcategoria){
            $conexao = Conexao::conectar();
            $select = "SELECT codSubCategoria FROM tbSubcategoria WHERE nomeSubCategoria LIKE ? AND descSubCategoria LIKE ?";

            $prepareStatement = $conexao->prepare($select);

            $prepareStatement->bindValue(1, $subcategoria->getNome());
            $prepareStatement->bindValue(2, $subcategoria->getDescricao());

            $prepareStatement->execute();

            $lista = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            $id = $lista['codSubCategoria'];
            return $id;
        }

        public static function atualizarFoto($subcategoria){
            $conexao = Conexao::conectar();

            $update = "UPDATE tbSubcategoria
                       SET fotoSubCategoria = ?
                       WHERE codSubCategoria = ?";
            
            $prepareStatement = $conexao->prepare($update);
            
            $prepareStatement->bindValue(1, $subcategoria->getFoto());
            $prepareStatement->bindValue(2, $subcategoria->getId());

            $prepareStatement->execute();

        }

        public static function listarEspecifico($subcategoria){
            $conexao = Conexao::conectar();
            $select = 'SELECT nomeSubCategoria, descSubCategoria, fotoSubCategoria FROM tbSubcategoria
                       WHERE codSubCategoria = ?';
            $prepareStatement = $conexao->prepare($select);
            
            $prepareStatement->bindValue(1, $subcategoria->getId());
            $prepareStatement->execute();
            $lista = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            return $lista;
        }

        public static function atualizar($subcategoria){
            $conexao = Conexao::conectar();

            $update = 'UPDATE tbSubcategoria SET nomeSubcategoria = ?, descSubCategoria = ?, fotoSubCategoria = ? WHERE codSubCategoria = ?';

            $prepareStatement = $conexao->prepare($update);
            $prepareStatement->bindValue(1, $subcategoria->getNome());
            $prepareStatement->bindValue(2, $subcategoria->getDescricao());
            $prepareStatement->bindValue(3, $subcategoria->getFoto());
            $prepareStatement->bindValue(4, $subcategoria->getId());

            $prepareStatement->execute();
        }

        public static function excluir($subcategoria){
            $conexao = Conexao::conectar();

            // explicar em aula minha ideia alternativa
            $select = 'SELECT fotoSubCategoria FROM tbSubcategoria WHERE codSubCategoria = ?';
            $delete = 'DELETE FROM tbSubcategoria WHERE codSubCategoria = ?';

            $prepareStatement1 = $conexao->prepare($select);
            $prepareStatement1->bindValue(1, $subcategoria->getId());
            $prepareStatement1->execute(); 
            $lista = $prepareStatement1->fetch(PDO::FETCH_ASSOC);
            $foto = $lista['fotoSubCategoria'];
            unlink('../'.$foto);

            $prepareStatement2 = $conexao->prepare($delete);
            $prepareStatement2->bindValue(1, $subcategoria->getId());
            $prepareStatement2->execute();

        }
    }
?>