<?php 

    require_once '../model/Categoria.php';
    require_once '../dao/DaoCategoria.php';

    header('Location: ../viewAdm/cadastroCategoria.php');

    $categoria = new Categoria();

    $id = $_GET['id'];
    $categoria->setId($id);
    DaoCategoria::excluir($categoria);

?>