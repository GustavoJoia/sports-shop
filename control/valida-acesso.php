<?php
    $login = $_POST['txt_loginAdm'];
    $senha = $_POST['txt_senhaAdm'];

    if( ($login == 'adm') && ($senha == '123') ){
        header("Location: ../viewAdm/dashboard.php");
        session_start();
        $_SESSION['login-session'] = $login;
        $_SESSION['senha-session'] = $senha;
    }
    else{
        header("Location: ../viewEveryone/loginAdm.php");
    }

?>