<?php

    require_once('../model/ItemVenda.php');
    session_start();
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="../assets/css/styles.css">
        <script type="" src="../assets/js/main.js"></script>
        <title>Catálogo - Sports Shop</title>
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
                        <li class="nav__item"><a href="produtos-fullCliente.php#produtos" class="nav__link">Produtos</a></li>
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
                        <a href="carrinho.php" class="cart"><span class="material-symbols-outlined align cart-icon">shopping_cart</span> <span><?php echo $qtdeCarrinho; ?></span></a>
                    </div>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>
        <main class="l-main">
        <section class="menu section bd-container" id="produtos">
                <span class="section-subtitle">Todos os produtos</span>
                <h2 class="section-title">Produtos</h2>

                <div class="menu__container row bd-grid">
                    <?php 
                        require_once '../dao/DaoProduto.php';

                        try {
                            $produtos = DaoProduto::listar(0);
                        } catch(PDOException $e){
                            echo $e->getMessage();
                        }    

                        foreach($produtos as $produto){ ?>
                            <div class="col menu__content">
                                <img src="<?php echo '../'.$produto['fotoProduto']; ?>" alt="" class="menu__img">
                                <h3 class="menu__name"><?php echo $produto['nomeProduto']; ?></h3>
                                <span class="menu__detail"><?php echo $produto['marcaProduto']; ?></span>
                                <span class="menu__preci">R$ <?php echo number_format($produto['precoProduto'], 2, ',','.'); ?></span>
                                <a href="produto-info.php?id=<?php echo $produto['codProduto']; ?>" class="button menu__button"><i class='bx bx-cart-alt'></i></a>
                            </div>
                        <?php } ?>
            
                </div>   
                </div>
            </section>
        </main>

        <!-- FOOTER -->
        <footer class="footer section bd-container">
            <div class="footer-background">
                <div class="footer__container bd-grid">
                    <div class="footer__content">
                        <a href="#" class="footer__logo">Sports Shop</a>
                        <span class="footer__description">E-commerce</span>
                        <div>
                            <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                            <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                            <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                        </div>
                    </div>

                    <div class="footer__content">
                        <h3 class="footer__title">Mapa</h3>
                        <ul>
                            <li><a href="index.php" class="footer__link">Inicio</a></li>
                            <li><a href="sobre.php" class="footer__link">Sobre</a></li>
                            <li><a href="index.php#colecoes" class="footer__link">Coleções</a></li>
                            <li><a href="index.php#produtos" class="footer__link">Produtos</a></li>
                            <li><a href="index.php#cadastro" class="footer__link">Contato</a></li>
                            <li><a href="cadastroCliente.php" class="footer__link">Cadastre-se</a></li>
                        </ul>
                    </div>

                    <div class="footer__content">
                        <h3 class="footer__title">Informações</h3>
                        <ul>
                            <li><a href="#" class="footer__link">Razão Social</a></li>
                            <li><a href="#" class="footer__link">Trabalhe Conosco</a></li>
                            <li><a href="#" class="footer__link">Politica de Privacidade</a></li>
                            <li><a href="#" class="footer__link">Termos de Serviço</a></li>
                        </ul>
                    </div>

                    <div class="footer__content">
                        <h3 class="footer__title">Endereço</h3>
                        <ul>
                            <li class="footer-address">São Paulo - Brasil</li>
                            <li class="footer-address">Av. Oceano Atlântico, 123</li>
                            <li class="footer-address">178 - 190 -431</li>
                            <li class="footer-address">sportsshope@email.com</li>
                        </ul>
                    </div>
                </div>
                <p class="footer__copy">&#169; 2022, Gabriel Goes, Gustavo Joia, Karina Yumi, Lorena Araujo e Luana Gabrielle. Todos os direitos reservados!</p>
            </div>

            
        </footer>

        <script src="https://unpkg.com/scrollreveal"></script>

    </body>
</html>