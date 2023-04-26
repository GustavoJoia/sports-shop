<?php

    require_once('../model/ItemVenda.php');
    session_start();
    header('Location: ../viewCliente/carrinho.php');

    $idVetorCarrinho = $_GET['id'];

    if (isset($_SESSION['carrinho'])){
        $carrinhoRecebido = $_SESSION['carrinho'];
        $carrinhoAtual = unserialize($carrinhoRecebido);

        unset($carrinhoAtual[$idVetorCarrinho]);
        $qtdeCarrinho = 0;
        foreach ($carrinhoAtual as $idVetor => $itemCarrinho) {
            $qtdeCarrinho += $itemCarrinho->getQtde();
        }

        if($qtdeCarrinho > 0){
            $carrinhoCookie = serialize($carrinhoAtual);
            $_SESSION['carrinho'] = $carrinhoCookie;
        } else {
            unset($_SESSION['carrinho']);
        }
    }
?>