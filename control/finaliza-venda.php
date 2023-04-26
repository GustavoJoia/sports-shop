<?php

    require_once('../model/Cliente.php');
    require_once('../model/Venda.php');
    require_once('../model/ItemVenda.php');
    require_once('../dao/DaoVenda.php');
    require_once('../dao/DaoItemVenda.php');

    header('Location: ../viewCliente/vendasAndamento.php');

    session_start();

    if (isset($_SESSION["carrinho"])){
        $carrinhorecebido =  $_SESSION["carrinho"]; 
        $carrinhoAtual = unserialize($carrinhorecebido);

        $cliente = new Cliente();
        $cliente->setId($_SESSION['login-idCliente']);        
        $venda = new Venda();
        $venda->setCliente($cliente);
        date_default_timezone_set('America/Sao_Paulo');
        $venda->setData(date('Y-m-d H:i:s'));
        $venda->setListaItem($carrinhoAtual);
        $venda->setStatus(1);
        $venda->setValorTotal($_GET['valortotal']);

        DaoVenda::cadastrar($venda);

        $venda->setId(DaoVenda::consultarId($venda));

        foreach($venda->getListaItem() as $itemvenda){
            DaoItemVenda::cadastrar($itemvenda, $venda);
        }

        unset($_SESSION['carrinho']);
    }
    else{
        header("Location: ../viewCliente/carrinho.php");
    }
?>