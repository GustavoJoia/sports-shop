<?php
    require_once 'Cliente.php';
    require_once 'ItemVenda.php';

    class Venda {

        private $idVenda;
        private $dataVenda;
        private $valorTotalVenda;
        private $statusVenda;
        private $cliente;
        private $listaItemVenda = [];

        public function getId(){
            return $this->idVenda;
        }

        public function getData(){
            return $this->dataVenda;
        }

        public function getValorTotal(){
            return $this->valorTotalVenda;
        }

        public function getStatus(){
            return $this->statusVenda;
        }

        public function getCliente(){
            return $this->cliente;
        }

        public function getListaItem(){
            return $this->listaItemVenda;
        }

        public function setId($id){
            $this->idVenda = $id;
        }

        public function setData($data){
            $this->dataVenda = $data;
        }

        public function setValorTotal($valor){
            $this->valorTotalVenda = $valor;
        }

        public function setStatus($status){
            $this->statusVenda = $status;
        }

        public function setCliente($cliente){
            $this->cliente = $cliente;
        }

        public function setListaItem($listaItemVenda){
            $this->listaItemVenda = $listaItemVenda;
        }

    }

?>