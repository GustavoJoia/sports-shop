<?php

    session_start();

    require_once '../model/Cliente.php';
    require_once '../dao/DaoCliente.php';

    $cliente = new Cliente();
    $email = $_POST['emailclienteLog'];
    $senha = $_POST['senhaclienteLog'];

    $id = $_GET['id'];

    $cliente->setEmail($email);
    $cliente->setSenha($senha);

    $resposta = DaoCliente::login($cliente);
    
    if($resposta == true){

        header('Location: ../viewCliente/produto-info.php?id='.$id);
        $cliente->setId(DaoCliente::consultarId($cliente));
        $dados = DaoCliente::buscarDados($cliente);
        $cliente->setNome($dados['nomeCliente']);

        $_SESSION['login-idCliente'] = $cliente->getId();
        $_SESSION['login-nomeCliente'] = $cliente->getNome();
        $_SESSION['login-emailCliente'] = $cliente->getEmail();
        $_SESSION['login-senhaCliente'] = $cliente->getSenha();

        unset($_SESSION['idProduto-redirect']);

    } else {
        header('Location: ../viewEveryone/loginCliente.php');
    }

?>