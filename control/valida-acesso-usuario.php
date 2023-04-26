<?php

    session_start();

    require_once '../model/Cliente.php';
    require_once '../dao/DaoCliente.php';
    require_once('../dao/DaoAcessos.php');
    require_once('../model/Acessos.php');

    $cliente = new Cliente();
    $email = $_POST['emailclienteLog'];
    $senha = $_POST['senhaclienteLog'];

    $cliente->setEmail($email);
    $cliente->setSenha($senha);

    $resposta = DaoCliente::login($cliente);
    
    if($resposta == true){

        header('Location: ../viewCliente/index.php');

        $cliente->setId(DaoCliente::consultarId($cliente));
        $dados = DaoCliente::buscarDados($cliente);
        $cliente->setNome($dados['nomeCliente']);

        $_SESSION['login-idCliente'] = $cliente->getId();
        $_SESSION['login-nomeCliente'] = $cliente->getNome();
        $_SESSION['login-emailCliente'] = $cliente->getEmail();
        $_SESSION['login-senhaCliente'] = $cliente->getSenha();
        $numAcessos = (DaoAcessos::contarAcessos()+1);
        $acessos = new Acessos();
        $acessos->setAcessos($numAcessos);
        DaoAcessos::adicionarAcesso($acessos);

    } else {
        header('Location: ../viewEveryone/loginCliente.php');
    }

?>