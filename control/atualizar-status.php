<?php

    require_once('../model/Venda.php');
    require_once('../dao/DaoVenda.php');
    require_once('../dao/DaoItemVenda.php');
    require_once('../model/Produto.php');
    require_once('../dao/DaoProduto.php');
    header('Location: ../viewAdm/vendas.php#cadastrados');

    $idVenda = $_POST['codVenda'];
    $status = $_POST['statusVenda'];
    $venda = new Venda();

    $venda->setId($idVenda);
    $venda->setStatus($status);
    date_default_timezone_set('America/Sao_Paulo');
    $venda->setData(date('Y-m-d H:i:s'));

    DaoVenda::atualizarStatus($venda);
    if($status == 6){
        $p = new Produto();
        
        $itens = DaoItemVenda::listarItemVenda($venda);
        foreach($itens as $item){
            $p->setId($item['codProduto']);
            $dadosP = DaoProduto::listarEspecifico($p);
            $p->setEstoque($dadosP['estoqueProduto']-$item['qtde']);
            DaoProduto::atualizarEstoque($p);
        }
    }
    

?>