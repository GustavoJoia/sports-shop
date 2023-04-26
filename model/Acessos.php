<?php

    class Acessos{
    private $id;
    private $acessos;

        public function setId($id){
            $this->id = $id;
        }
        public function setAcessos($acessos){
            $this->acessos = $acessos;
        }

        public function getId(){
            return $this->id;
        }

        public function getAcessos(){
            return $this->acessos;
        }
    }

?>