<?php
    require_once 'Produto.php';

    class ItemVenda {

        private $idItemVenda;
        private $qtdeItemVenda;
        private $subtotalItemVenda;
        private $produto;

        public function __construct(){
            $this->idItemVenda = 0;
            $this->produto = new Produto();
        }

        public function getId(){
            return $this->idItemVenda;
        }

        public function getQtde(){
            return $this->qtdeItemVenda;
        }

        public function getSubtotal(){
            return $this->subtotalItemVenda;
        }

        public function getProduto(){
            return $this->produto;
        }

        public function setId($id){
            $this->idItemVenda = $id;
        }

        public function setQtde($qtde){
            $this->qtdeItemVenda = $qtde;
        }

        public function setSubtotal($subtotal){
            $this->subtotalItemVenda = $subtotal;
        }

        public function setProduto($produto){
            $this->produto = $produto;
        }

    }

?>