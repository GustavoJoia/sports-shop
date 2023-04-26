<?php

    class Categoria {

        private $idCategoria;
        private $nomeCategoria;
        private $descricaoCategoria;
        private $foto;

        public function getId(){
            return $this->idCategoria;
        }

        public function getNome(){
            return $this->nomeCategoria;
        }

        public function getDescricao(){
            return $this->descricaoCategoria;
        }

        public function getFoto(){
            return $this->foto;
        }

        public function setId($id){
            $this->idCategoria = $id;
        }

        public function setNome($nome){
            $this->nomeCategoria = $nome;
        }

        public function setDescricao($descricao){
            $this->descricaoCategoria = $descricao;
        }

        public function setFoto($foto){
            $this->foto = $foto;
        }

    }

?>