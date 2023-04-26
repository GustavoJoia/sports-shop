<?php

    require_once('../model/Produto.php');
    require_once('../model/Categoria.php');
    require_once('../model/Subcategoria.php');
    require_once('../model/ItemVenda.php');
    session_start();
    include_once '../control/valida-permanencia-cliente.php';

    if (isset($_SESSION["carrinho"])){
        $carrinhoRecebido =  $_SESSION["carrinho"];
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="../assets/css/styles.css">
        <script type="" src="../assets/js/main.js"></script>
        <title>Carrinho - Sports Shop</title>
    </head>
        
    <body>

        <!-- SCROLL TOP -->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

        <!-- HEADER -->
        <header class="l-header" id="header">
        <nav class="nav home-container fixed-top">
                <a href="index.php" class="nav__logo">Sports Shop</a> 

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
                                <a href="vendasAndamento.php" class="drop_a">Meus pedidos</a>
                                <a href="../control/logout-cliente.php" class="blue drop_a">Sair</a>
                            </div>
                    </div>
                    <div class="cart">
                        <span class="material-symbols-outlined align cart-icon">shopping_cart</span> <span><?php echo $qtdeCarrinho; ?></span>
                    </div>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>
        <main class="l-main">
            <div class="carrinho__main">
                <div class="produtos__carrinho">
                    <div class="card">
                        <div class="card-header darkblue">
                            <h4>Produtos</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="align-middle col">#</th>
                                        <th scope="align-middle col">Foto</th>
                                        <th scope="align-middle col">Nome</th>
                                        <th scope="align-middle col">Marca</th>
                                        <th scope="align-middle col">Quantidade</th>
                                        <th scope="align-middle col">Preço</th>
                                        <th scope="align-middle col">Excluir</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                    <?php

                                        require_once '../model/ItemVenda.php';
                                        require_once '../model/Produto.php';

                                        $valorTotal = 0;
                                    if (isset($_SESSION['carrinho'])) {
                                        foreach ($carrinhoAtual as $idVetorCarrinho => $itemCarrinho) {
                                            $valorTotal += $itemCarrinho->getSubtotal();

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $itemCarrinho->getProduto()->getId(); ?></th>
                                        <td class="align-middle"><img class="rounded" src="<?php echo '../'.$itemCarrinho->getProduto()->getFoto(); ?>" alt=""></td>
                                        <td class="align-middle"><?php echo $itemCarrinho->getProduto()->getNome(); ?></td>
                                        <td class="align-middle"><?php echo $itemCarrinho->getProduto()->getMarca(); ?></td>
                                        <td class="align-middle">
                                            <div class="qtd_range">
                                                <span class="material-symbols-outlined"><a href ="../control/aumentar-qtde.php?id=<?php echo $idVetorCarrinho ?>" class="redIcon">add</a></span>
                                                <input type="number" id="input-qtde-<?php echo $itemCarrinho->getProduto()->getId(); ?>" class="input_size" min=1 disabled>
                                                <script> 
                                                    var input = document.getElementById('input-qtde-<?php echo $itemCarrinho->getProduto()->getId(); ?>')
                                                    input.value = <?php echo $itemCarrinho->getQtde(); ?>
                                                </script>
                                                <span class="material-symbols-outlined"><a href ="../control/remover-qtde.php?id=<?php echo $idVetorCarrinho; ?>" class="redIcon">remove</a></span>
                                            </div>
                                        </td>
                                        <td class="align-middle">R$ <?php echo number_format($itemCarrinho->getProduto()->getPreco(), 2, ',', '.'); ?></td>
                                        <td class="align-middle">
                                            <div class="qtd_range">
                                                <span class="material-symbols-outlined"><a href='../control/remover-carrinho.php?id=<?php echo $idVetorCarrinho; ?>' class="redIcon">delete
                                                </a></span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php }
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="resumo__carrinho">
                        <div class="card espef">
                            <div class="card-header green">
                                <h4>Resumo</h4>
                            </div>
                            <div class="card-body espef_cd">
                                <div class="info_preco">
                                    <div class="info_total">
                                        <h4> Subtotal</h4>
                                        <p class="espef_p"> R$ <?php echo number_format($valorTotal, 2, ',','.'); ?></p>
                                    </div>
                                    <div class="info_qtde">
                                        <h4>Itens</h4>
                                        <p class="espef_p"><?php echo $qtdeCarrinho; ?></p>
                                    </div>
                                </div>
                                <div class="button__carrinho">
                                    <a href="../control/finaliza-venda.php?valortotal=<?php echo $valorTotal; ?>"><button class="button green_button">Finalizar</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="img__carrinho">
                            <img src="../assets/img/carrinho.png" alt="" class="about__img">
                        </div>
                </div>
            </div>
        </main>

        <script src="https://unpkg.com/scrollreveal"></script>

    </body>
</html>