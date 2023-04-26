<?php

    require_once '../dao/DaoCliente.php';
    require_once '../model/Cliente.php';

    $cliente = new Cliente();
    $cliente->setEmail($_SESSION['login-emailCliente']);
    $cliente->setSenha($_SESSION['login-senhaCliente']);

    $resposta = DaoCliente::login($cliente);

    if($resposta == false){
        header('Location: ../viewEveryone/loginCliente.php');
    }

?>