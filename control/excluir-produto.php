<?php 

    require_once '../model/Produto.php';
    require_once '../dao/DaoProduto.php';

    header('Location: ../viewAdm/cadastroProduto.php');

    $produto = new Produto();

    $id = $_GET['id'];
    $produto->setId($id);
    DaoProduto::excluir($produto);

?>