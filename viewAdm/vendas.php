<?php 
    session_start();
    
    // include("valida-permanencia.php");
    include_once("../control/valida-permanencia.php");
    // require("valida-permanencia.php");
    // require_once("valida-permanencia.php");
    require_once('../dao/DaoVenda.php');
    require_once('../model/Venda.php');

    $dados = DaoVenda::listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- BOX ICONS-->
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/sidebars.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <title>ADM - Vendas</title>
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
                <div class="li-back">
                <a href="cadastroCategoria.php"><li class="span__sidebar">Categorias</li></a>
                </div>
                <div class="li-back">
                    <a href="cadastroSubcategoria.php"><li class="span__sidebar">SubCategorias</li></a>
                </div>
                <div class="li-back">
                    <a href="clientes.php"><li class="span__sidebar">Clientes</li></a>
                </div>
                <div class="li-back-ativo">
                        <li class="span__sidebar">Vendas</li>
                </div>
                <div class="li-sair">
                    <div class="li-back-sair">
                        <a href="../control/logout.php"><ul class="ul-sidebar">Sair</ul></a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="venda-main">
            <h2 class="section-title-alt">Vendas</h2>
            <div class="info-vendas card blue" style="width: 35vw; padding: 1.5em;">
                <div class="info-line">
                    <ul class="row">
                        <li><p class="info-cod"> 1 - Aguardando administração</p></li>
                        <li><p class="info-cod"> 2 - Confirmado (administrador) </p></li>
                        <li><p class="info-cod"> 3 - Em trânsito </p></li>
                    </ul>
                    <ul class="row">
                        <li><p class="info-cod"> 4 - Cancelado (cliente)</p></li>
                        <li><p class="info-cod"> 5 - Interrompida (administrador) </p></li>
                        <li><p class="info-cod"> 6 - Finalizada </p></li>
                    </ul> 
                </div>
            </div>
            <section id="cadastrados" class="section__cadastrados">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data da Venda</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Itens</th>
                            <th scope="col">Ver Itens</th>
                            <th scope="col">Status</th>
                            <th scope="col">Atualizar status</th>
                        </tr>
                    </thead>    
                    <tbody>
                        <?php

                            foreach($dados as $venda){

                        ?>  
                        <tr>
                            <form method="post" action="../control/atualizar-status.php">
                                <td name="codVenda" class="align-middle"><input name="codVenda" value="<?php echo $venda['codVenda'] ?>" type="hidden"><?php echo $venda['codVenda']; ?></td>
                                <td class="align-middle"><?php
                                                            $data = date_create($venda['dataVenda']);
                                                            echo date_format($data, 'd/m/Y H:i'); 
                                                        ?></td>
                                <td class="align-middle"><?php echo $venda['valorTotalVenda']; ?></td>
                                <td class="align-middle"><?php echo $venda['codCliente']; ?></td>
                                <td class="align-middle"><?php echo $venda['itensVenda']; ?></td>
                                <td class="align-middle"><a href="listaProduto.php?id=<?php echo $venda['codVenda']; ?>"><span style="color: black;" class="material-symbols-outlined">search</span></a></td>
                                <td class="align-middle"><?php echo $venda['statusVenda']; ?></td>
                                <td class="align-middle">
                                    <input type="number" class="input_size" id="statusVenda" name="statusVenda">
                                    <button type="submit" class="smallb"><span class="material-symbols-outlined">check</span></button>
                                </td>
                            </form>
                        </tr> <?php } ?>
                    </tbody>        
                <br>
        </main>
    </body>
</html>