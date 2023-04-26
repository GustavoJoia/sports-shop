<?php

    class Subcategoria {

        private $idSubcategoria;
        private $nomeSubCategoria;
        private $descSubCategoria;
        private $foto;

        public function getId(){
            return $this->idSubcategoria;
        }

        public function getNome(){
            return $this->nomeSubCategoria;
        }

        public function getDescricao(){
            return $this->descSubCategoria;
        }

        public function getFoto(){
            return $this->foto;
        }

        public function setId($id){
            $this->idSubcategoria = $id;
        }

        public function setNome($nome){
            $this->nomeSubCategoria = $nome;
        }

        public function setDescricao($descricao){
            $this->descSubCategoria = $descricao;
        }

        public function setFoto($foto){
            $this->foto = $foto;
        }

    }

?>