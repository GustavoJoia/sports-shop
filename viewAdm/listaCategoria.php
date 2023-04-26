<?php 
    session_start();
    
    // include("valida-permanencia.php");
    include_once("../control/valida-permanencia.php");
    // require("valida-permanencia.php");
    // require_once("valida-permanencia.php");
?>

<!DOCTYPE html>
<html lang="pt-BR"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- BOX ICONS-->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="../assets/css/sidebars.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <title>ADM - Categoria</title>
    </head>
        
    <body>
        <nav class="menu" tabindex="0">
            <div class="smartphone-menu-trigger"></div>
          <header class="avatar">
            <span class="material-symbols-outlined">supervisor_account</span>
            <h2 class="h2-adm">Área do administrador</h2>
          </header>
            <div class="sidebar-options">   
                <div class="li-back">
                    <a href="dashboard.php"><li class="span__sidebar">Dashboard</li></a>
                </div>
                <div class="li-back">
                    <a href="cadastroProduto.php"><li class="span__sidebar">Produtos</li></a>
                </div>
                <div class="li-back-ativo">
                    <li class="span__sidebar">Categorias</li>
                </div>
                <div class="li-back">
                    <a href="cadastroSubcategoria.php"><li class="span__sidebar">SubCategorias</li></a>
                </div>
                <div class="li-back">
                    <a href="clientes.php"><li class="span__sidebar">Clientes</li></a>
                </div>
                <div class="li-back">
                    <a href="vendas.php"><li class="span__sidebar">Vendas</li></a>
                </div>
                <div class="li-sair">
                    <div class="li-back-sair">
                        <a href="../control/logout.php"><ul class="ul-sidebar">Sair</ul></a>
                    </div>
                </div>
            </div>
        </nav>

        <main>

            <div class="card-flex">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a href="cadastroCategoria.php" class="nav-link nav-green">Cadastrar categoria</a>
                        </li>
                        <li class="nav-item">
                            <a href="listaSubcategoria.php" class="nav-link nav-green">SubCategorias cadastradas</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">

                    
                </div>
            </div> 

        </main>

    </body>
</html>