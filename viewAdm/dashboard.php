<?php 
    session_start();
    
    // include("valida-permanencia.php");
    include_once("../control/valida-permanencia.php");
    // require("valida-permanencia.php");
    // require_once("valida-permanencia.php");

    require_once '../dao/DaoCliente.php';
    require_once '../dao/DaoProduto.php';
    require_once('../dao/DaoVenda.php');
    require_once('../dao/DaoAcessos.php');

    $qtdeClientes = DaoCliente::contarClientes();
    $qtdeProdutos = DaoProduto::contarProdutos();
    $qtdePedidos = DaoVenda::contar();
    $qtdeVendas = DaoVenda::contarVendas();
    $receita = DaoVenda::contarReceita();
    $acessos = DaoAcessos::contarAcessos();

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
        <title>ADM - Dashboard</title>
    </head>
        
    <body>
            <h2 class="section-title-alt-dash2">DASHBOARD - CONTROLE</h2>
                <nav class="menu" tabindex="0">
                    <div class="smartphone-menu-trigger"></div>
                <header class="avatar">
                    <span class="material-symbols-outlined">supervisor_account</span>
                    <h2 class="h2-adm">Área do administrador</h2>
                </header>
                    <div class="sidebar-options">   
                        <div class="li-back-ativo">
                            <li class="span__sidebar">Dashboard</li>
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
            <div class="row">
            <div class="card-dash blue">
                <h2>Clientes</h2>
                <p> Total de Clientes</p>
                <h2><?php echo $qtdeClientes; ?>
                <img class="image-dash" src="../assets/img/iconCliente.gif" alt="settings" />
            </div>
        
            <div class="card-dash blue">
                <h2>Vendas</h2>
                <p>Total de Vendas</p>
                <h2><?php echo $qtdeVendas; ?>
                <img class="image-dash" src="../assets/img/iconVendas.gif" alt="settings" />
            </div>
        
            <div class="card-dash blue">
                <h2>Produtos</h2>
                <p>Total de Produtos</p>
                <h2><?php echo $qtdeProdutos; ?>
                <img class="image-dash" src="../assets/img/iconProduto.gif" alt="settings" />
            </div>

            <div class="card-dash blue">
                <h2>Pedidos</h2>
                <p> Total de Pedidos</p>
                <h2><?php echo $qtdePedidos; ?>
                <img class="image-dash" src="../assets/img/iconPedidos.gif" alt="settings" />
            </div>

            <div class="card-dash blue">
                <h2>Visitas de usuários</h2>
                <p> Total de visitas</p>
                <h2><?php echo $acessos; ?>
                <img class="image-dash" src="../assets/img/iconVisitas.gif" alt="settings" />
            </div>
        
            <div class="card-dash blue_02">
                <h2 class="receita">Receita</h2>
                <p>Total</p>
                <h2 class="receitaValor"><?php echo number_format($receita, 2, ',', '.'); ?>
                <img class="image-dash" src="../assets/img/iconCapital.gif" alt="settings" />
            </div>
            </div>
           <h2 class="section-title-alt-dash">ITENS MAIS VENDIDOS</h2>
                <section class="section__cadastrados" id="cadastrados">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Vendas</th>
                                <th scope="col">Preço</th>
                                <th scope="col">Estoque</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Subcategoria</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            require_once "../dao/DaoItemVenda.php";
                            $produtos = DaoItemVenda::maisVendido();
                            
                            foreach($produtos as $produto){ ?>
                                <tr>
                                    <th scope="row"><?php echo $produto['codProduto']; ?></th>
                                    <td><img src="<?php echo '../'.$produto['fotoProduto']; ?>" class="rounded" width="20%"></td>
                                    <td class="align-middle"><?php echo $produto['nomeProduto']; ?></td>
                                    <td class="align-middle"><?php echo $produto['Quantidade']; ?></td>
                                    <td class="align-middle"><?php echo $produto['precoProduto']; ?> </td>
                                    <td class="align-middle"><?php echo $produto['estoqueProduto']; ?> </td>
                                    <td class="align-middle"><?php echo $produto['marcaProduto']; ?> </td>
                                    <td class="align-middle"><?php echo $produto['nomeCategoria']; ?> </td>
                                    <td class="align-middle"><?php echo $produto['nomeSubCategoria']; ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
    </body>
</html>