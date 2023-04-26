<?php

    header('Location: ../viewEveryone/loginCliente.php');
    $id = $_GET['id'];

    session_start();
    $_SESSION['idProduto-redirect'] = $id;

?>