<?php

    require_once('../model/Venda.php');
    require_once('../model/Cliente.php');
    require_once('../model/ItemVenda.php');
    require_once('../dao/DaoVenda.php');
    require_once('../dao/DaoItemVenda.php');
    session_start();

    $cliente = new Cliente();
    $cliente->setId($_SESSION['login-idCliente']);
    $vendas = DaoVenda::listarFinalizadas($cliente);

    
    include_once '../control/valida-permanencia-cliente.php';

    if (isset($_SESSION["carrinho"])){
        $carrinhoRecebido = $_SESSION["carrinho"]; 
        $carrinhoAtual = unserialize($carrinhoRecebido);
        $qtdeCarrinho = 0;
        foreach ($carrinhoAtual as $idVetorCarrinho => $itemCarrinho) {
            $qtdeCarrinho += $itemCarrinho->getQtde();
        }

    }
    else{
        $qtdeCarrinho = 0;
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- BOX ICONS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/sidebars.css">
        <title>Meus Pedidos - Sports Shop</title>
    </head>
        
    <body>

        <!-- SCROLL TOP -->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!-- HEADER -->
        <header class="l-header" id="header">
            <nav class="nav home-container fixed-top">
                <a href="#" class="nav__logo">Spo</a> 

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="index.php#inicio" class="nav__link">Inicio</a></li>
                        <li class="nav__item"><a href="index.php#colecoes" class="nav__link">Coleções</a></li>
                        <li class="nav__item"><a href="produtos-fullCliente.php" class="nav__link">Produtos</a></li>
                        <li class="nav__item"><a href="sobre.php" class="nav__link">Sobre</a></li>
                        <li class="nav__item"><a href="index.php#cadastro" class="nav__link">Contato</a></li>
                    </ul>
                </div>
                <div class="align-info">
                    <div class="info">
                    <?php

                            $nomeBruto = $_SESSION['login-nomeCliente'];
                            $array = explode(' ', $nomeBruto);
                            $primeiroNome = $array[0];

                            ?>
                            <span class="welcome_span">Olá,
                            <span class="nomeCliente"> <?php echo $primeiroNome; ?></span>
                            <span class="material-symbols-outlined align ">expand_more</span>
                            </span>
                            <div class="dropdown-content">
                            <a href="#" class="drop_a">Meus pedidos</a>
                            <a href="../control/logout-cliente.php" class="blue drop_a">Sair</a>
                            </div>
                    </div>
                    <div class="cart">
                        <a href="carrinho.php" class="cart"><span class="material-symbols-outlined align cart-icon">shopping_cart</span> <span><?php echo $qtdeCarrinho; ?></span></a>
                    </div>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
                <nav class="menu" tabindex="0">
            <div class="smartphone-menu-trigger"></div>
          <header class="avatar">
            <span class="material-symbols-outlined">local_shipping</span>
            <h2 class="h2-adm">Meus <br>Pedidos</h2>
          </header>
            <div class="sidebar-options">
                <div class="li-back">
                    <a href="vendasAndamento.php"><li class="span__sidebar">Em andamento</li></a>
                </div>
                <div class="li-back-ativo">
                    <a href="#"><li class="span__sidebar">Finalizadas</li></a>
                </div>
                <div class="li-back">
                    <a href="vendasCanceladas.php"><li class="span__sidebar">Canceladas</li></a>
                </div>
            </div>
        </nav>

            </nav>
        </header>

        <main>
            <div class="confirmadas">
                <?php
                foreach ($vendas as $venda) {
                ?>
                <div id="accordion">
                    <div class="card card_andamento">
                        <div class="card-header" id="heading-<?php echo $venda['codVenda']; ?>">
                        <h5 class="mb-0">
                            <button class="btn white btn-link" data-toggle="collapse" data-target="#collapse-<?php echo $venda['codVenda']; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $venda['codVenda']; ?>">
                            PEDIDO: <?php echo $venda['codVenda']; ?> <span class="material-symbols-outlined align">add</span>
                            </button>
                            <p><?php 
                                $data = date_create($venda['dataVenda']);
                                echo date_format($data, 'd/m/Y H:i'); 
                            ?></p>
                        </h5>
                        </div>

                        <div id="collapse-<?php echo $venda['codVenda']; ?>" class="collapse" aria-labelledby="heading-<?php echo $venda['codVenda']; ?>" data-parent="#accordion">
                        <div class="card-body">
                            <div class="about__container  bd-grid">
                                <div class="about__data">
                                    <span class="span__home section-subtitle">Status</span>
                                    <h2 class="section-title">Finalizado</h2>
                                    <p class="about__description black">O processo foi concluído. Aproveite sua compra!</p>
                                </div>
                                <img src="../assets/img/finalizado.png" class="about__img">
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        require_once('../model/ItemVenda.php');
                                        require_once('../dao/DaoItemVenda.php');
                                        require_once('../model/Venda.php');
                                        $v = new Venda();
                                        $v->setId($venda['codVenda']);
                                        $itens = DaoItemVenda::listarItemVenda($v);

                                        foreach($itens as $item){
                                    ?>
                                    <tr>
                                        <td><?php echo $item['codProduto']; ?></td>
                                        <td><?php echo $item['nomeProduto']; ?></td>
                                        <td><?php echo $item['qtde']; ?></td>
                                        <td><?php echo $item['subTotal']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div> <?php }?>
            </div>

        </main>
    </body>
</html>