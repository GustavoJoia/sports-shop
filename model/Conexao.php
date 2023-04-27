<?php
    class Conexao
    {
        public static function conectar()
        {
            $conexao = new PDO('mysql:host=fdb30.awardspace.net;dbname=3763351_crud;charset=utf8', '3763351_crud', '');
            //$conexao = new PDO('mysql:host=localhost;dbname=3763351_crud;charset=utf8', 'root', '');
            
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conexao;
        }
    }
?>
