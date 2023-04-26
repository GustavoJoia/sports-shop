<?php 

    require_once '../model/Subcategoria.php';
    require_once '../dao/DaoSubcategoria.php';

    header('Location: ../viewAdm/cadastroSubcategoria.php');

    $subcategoria = new Subcategoria();

    $id = $_GET['id'];
    $subcategoria->setId($id);
    DaoSubcategoria::excluir($subcategoria);

?>