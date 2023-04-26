<?php

    require_once('../model/Venda.php');
    require_once('../dao/DaoVenda.php');
    header('Location: ../viewCliente/vendasCanceladas.php');

    $idVenda = $_GET['id'];
    $status = 4;
    $venda = new Venda();

    $venda->setId($idVenda);
    $venda->setStatus($status);
    date_default_timezone_set('America/Sao_Paulo');
    $venda->setData(date('Y-m-d H:i:s'));

    DaoVenda::atualizarStatus($venda);

?>