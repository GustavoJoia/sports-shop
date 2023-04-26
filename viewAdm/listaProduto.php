<?php 
    session_start();
    
    // include("valida-permanencia.php");
    include_once("../control/valida-permanencia.php");
    $id = $_GET['id'];
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
        <title>ADM - Itens da Venda</title>  
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
                    <a href="cadastroProduto.php"><li class="span__sidebar">Produtos</li>
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
                <a href="vendas.php#cadastrados" class="nav-link button side nav-green">Voltar</a>
            </div>

            <h2 class="section-title-alt form-produto">Itens da venda Nº <?php echo $id; ?></h2>
            <section class="section__cadastrados" id="cadastrados">
                <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">SubTotal</th>
                    <th scope="col">Estoque</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    require_once "../dao/DaoItemVenda.php";
                    require_once('../model/Venda.php');
                    require_once('../model/Produto.php');
                    require_once('../dao/DaoProduto.php');
                    $v = new Venda();
                    $p = new Produto();
                    $v->setId($id);
                    $produtos = DaoItemVenda::buscarProdutos($v);
                    
                            $p->setId($produtos[0]);
                            $ps = DaoProduto::listarViaItemVenda($v);
                            foreach($ps as $produto){
                        ?>
                        <tr>
                            <th scope="row"><?php echo $produto['codProduto']; ?></th>
                            <td> <img src="<?php echo '../'.$produto['fotoProduto']; ?>" class="rounded" width="20%"></td>
                            <td class="align-middle"><?php echo $produto['nomeProduto']; ?></td>
                            <td class="align-middle"><?php echo $produto['qtde']; ?> </td>
                            <td class="align-middle"><?php echo $produto['subTotal']; ?> </td>
                            <td class="align-middle"><?php echo $produto['estoqueProduto']; ?> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </section>   

        </main>

    </body>
</html>