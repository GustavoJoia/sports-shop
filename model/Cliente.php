<?php

    class Cliente {

        private $idCliente;
        private $nomeCliente;
        private $cpfCliente;
        private $emailCliente;
        private $senhaCliente;
        private $logradouroCliente;
        private $numLogCliente;
        private $compCliente;
        private $bairroCliente;
        private $cidadeCliente;
        private $ufCliente;
        private $cepCliente;

        public function getId(){
            return $this->idCliente;
        }

        public function getNome(){
            return $this->nomeCliente;
        }

        public function getCpf(){
            return $this->cpfCliente;
        }

        public function getEmail(){
            return $this->emailCliente;
        }

        public function getSenha(){
            return $this->senhaCliente;
        }

        public function getLogradouro(){
            return $this->logradouroCliente;
        }

        public function getNumLog(){
            return $this->numLogCliente;
        }

        public function getComp(){
            return $this->compCliente;
        }

        public function getBairro(){
            return $this->bairroCliente;
        }

        public function getCidade(){
            return $this->cidadeCliente;
        }

        public function getUf(){
            return $this->ufCliente;
        }

        public function getCep(){
            return $this->cepCliente;
        }

        public function setId($id){
            $this->idCliente = $id;
        }

        public function setNome($nome){
            $this->nomeCliente = $nome;
        }

        public function setCpf($cpf){
            $this->cpfCliente = $cpf;
        }

        public function setEmail($email){
            $this->emailCliente = $email;
        }

        public function setSenha($senha){
            $this->senhaCliente = $senha;
        }

        public function setLogradouro($logradouro){
            $this->logradouroCliente = $logradouro;
        }

        public function setNumLog($numLog){
            $this->numLogCliente = $numLog;
        }

        public function setComp($comp){
            $this->compCliente = $comp;
        }

        public function setBairro($bairro){
            $this->bairroCliente = $bairro;
        }

        public function setCidade($cidade){
            $this->cidadeCliente = $cidade;
        }

        public function setUf($uf){
            $this->ufCliente = $uf;
        }

        public function setCep($cep){
            $this->cepCliente = $cep;
        }

    }

?>