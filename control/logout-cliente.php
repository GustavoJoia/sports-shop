<?php

    header('Location: ../viewEveryone/index.php');

    session_start();
    unset($_SESSION['login-idCliente']);
    unset($_SESSION['login-nomeCliente']);
    unset($_SESSION['login-senhaCliente']);
    session_destroy();

?>