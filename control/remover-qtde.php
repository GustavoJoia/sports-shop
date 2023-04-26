<?php

    require_once('../model/ItemVenda.php');
    session_start();
    header('Location: ../viewCliente/carrinho.php');

    $idVetorCarrinho = $_GET['id'];

    if (isset($_SESSION['carrinho'])){
        $carrinhoRecebido = $_SESSION['carrinho'];
        $carrinhoAtual = unserialize($carrinhoRecebido);

        if ($carrinhoAtual[$idVetorCarrinho]->getQtde() > 1) {
            $carrinhoAtual[$idVetorCarrinho]->setQtde($carrinhoAtual[$idVetorCarrinho]->getQtde() - 1);
            $carrinhoAtual[$idVetorCarrinho]->setSubtotal($carrinhoAtual[$idVetorCarrinho]->getQtde() * $carrinhoAtual[$idVetorCarrinho]->getProduto()->getPreco());
        }

        $carrinhoCookie = serialize($carrinhoAtual);
        $_SESSION['carrinho'] = $carrinhoCookie;
    }

?>