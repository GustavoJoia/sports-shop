<?php

    require_once 'Categoria.php';
    require_once 'Subcategoria.php';

    class Produto {

        private $idProduto;
        private $nomeProduto;
	    private $estoqueProduto;
	    private $marcaProduto;
        private $precoProduto;
        private $categoria;
        private $subcategoria;
	    private $foto;	

        public function __construct(){
            $this->categoria = new Categoria();
            $this->subcategoria = new Subcategoria();
        }

        public function getId(){
            return $this->idProduto;
        }

        public function getNome(){
            return $this->nomeProduto;
        }

	  public function getEstoque(){
	  	return $this->estoqueProduto;
	  }

	  public function getMarca(){
	  	return $this->marcaProduto;
	  }

        public function getPreco(){
            return $this->precoProduto;
        }

	  public function getCategoria(){
            return $this->categoria;
        }

	  public function getSubcategoria(){
            return $this->subcategoria;
        }

        public function setId($id){
            $this->idProduto = $id;
        }

        public function setNome($nome){
            $this->nomeProduto = $nome;
        }

        public function setEstoque($estoque){
            $this->estoqueProduto = $estoque;	
        }

        public function setMarca($marca){
            $this->marcaProduto = $marca;	
        }

        public function setPreco($preco){
            $this->precoProduto = $preco;
        }

        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        public function setSubcategoria($subcategoria){
            $this->subcategoria = $subcategoria;
        }

        public function getFoto(){
            return $this->foto;
        }

        public function setFoto($foto){
            $this->foto = $foto;
        }

    }

?>