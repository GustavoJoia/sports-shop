<?php

    require_once('../model/Conexao.php');
    require_once('../model/Acessos.php');

    class DaoAcessos{

        public static function contarAcessos(){
            $conexao = Conexao::conectar();
            $select = 'SELECT numAcessos FROM tbAcessos';
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();
            foreach($lista as $acessos){
                return $acessos['numAcessos'];
            }
        }

        public static function adicionarAcesso($acessos){
            $conexao = Conexao::conectar();
            $update = 'UPDATE tbAcessos SET numAcessos = ? WHERE codAcesso = 1';
            $prepare = $conexao->prepare($update);
            $prepare->bindValue(1, $acessos->getAcessos());
            $prepare->execute();
        }

    }

?>