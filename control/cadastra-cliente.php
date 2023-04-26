<?php

    header('Location: ../viewEveryone/cadastroCliente.php');

    require_once '../dao/DaoCliente.php';
    require_once '../model/Cliente.php';

    $cliente = new Cliente();
    $cliente->setNome($_POST['nomecliente']);
    $cliente->setCpf($_POST['cpfcliente']);
    $cliente->setEmail($_POST['emailcliente']);
    $cliente->setSenha($_POST['senhacliente']);
    $cliente->setLogradouro($_POST['logradourocliente']);
    $cliente->setCep($_POST['cepcliente']);
    $cliente->setNumLog($_POST['numlogcliente']);
    $cliente->setBairro($_POST['bairrocliente']);
    $cliente->setCidade($_POST['cidadecliente']);
    $cliente->setUf($_POST['ufcliente']);
    $cliente->setComp($_POST['complementocliente']);

    DaoCliente::cadastrar($cliente);

?>