<?php
    if( ($_SESSION['login-session'] != 'adm') || ($_SESSION['senha-session'] != '123') ){
        header("Location: ../viewEveryone/loginAdm.php");
    }
?>