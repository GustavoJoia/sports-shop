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
        <title>Início - Sports Shop</title>
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
                        <li class="nav__item"><a href="index.php#produtos" class="nav__link">Produtos</a></li>
                        <li class="nav__item"><a href="sobre.php" class="nav__link">Sobre</a></li>
                        <li class="nav__item"><a href="index.php#cadastro" class="nav__link">Contato</a></li>
                    </ul>
                </div>
                <div>
                    <ul class="nav__list">
                        <li class="nav__item log"><a class="log" href="cadastroCliente.php">Cadastre-se</a></li>
                        <li class="nav__item log"><a class="log" href="loginCliente.php">Login</a></li>
                    </ul>
                    
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>
        <main class="l-main">
            <!-- HOME -->
            <section class="home" id="inicio">
                <div class="home-border home__container bd-container">
                <div id="carouselExampleInterval" class="carousel__index carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="2800">
                            <img src="../assets/img/variety.jpg" class="d-block w-1500" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="2800">
                            <img src="../assets/img/football.jpg" class="d-block w-1500" alt="...">
                            </div>
                        </div>
                        <span class="span__home section-subtitle">A melhor no esporte</span>
                        <h2 class="section-title">Inicie sua partida</h2>
                        <div class="menu__container bd-grid">
                        <a href="#colecoes">    
                            <div class="menu__content-top">
                                <img src="../assets/img/img1.webp" alt="" class="menu__img-top menu__img">
                                <h3 class="menu__name-top">Categoria</h3>
                            </div>
                        </a>
                        <a href="#produtos">
                            <div class="menu__content-top">
                                <img src="../assets/img/img2.jpg" alt="" class="menu__img-top menu__img">
                                <h3 class="menu__name-top">Produtos</h3>
                            </div>
                        </a>
                        <a href="sobre.php">
                            <div class="menu__content-top">
                                <img src="../assets/img/img3.webp" alt="" class="menu__img-top menu__img">
                                <h3 class="menu__name-top">Sobre nós</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            <!-- COLEÇÕES -->
            <section class="services section bd-container" id="colecoes">
                <span class="section-subtitle">Categorias</span>
                <h2 class="section-title">Aqui você encontra</h2>

                <div class="services__container row bd-grid">
                    <?php 
                        require_once '../dao/DaoCategoria.php';
                    
                        try{
                            $categorias = DaoCategoria::listar(1);
                        }catch(PDOException $e){
                            echo $e;
                        }    
                        foreach($categorias as $categoria){ ?>
                            <div class="col-sm services__content">
                                <img src="<?php echo '../'.$categoria['fotoCategoria']; ?>" class="services__img">
                                <h3 class="services__title"><a href="#produtos">Ver produtos</a></h3>
                                <p class="services__description"><?php echo $categoria['descCategoria']; ?></p>
                            </div>
                        <?php } ?>    
                </div>
                <div class="row menu__container bd-grid">
                    <div class="col">
                        
                    </div>
                    <div class="col"></div>
                    <div class="col"><a class="nav-blue button align-center" href="#produtos">Ver mais >></a></div>
                </div>
            </section>

            <!-- MENU -->
            <section class="menu section bd-container" id="produtos">
                <span class="section-subtitle">Especial</span>
                <h2 class="section-title">Novidades!</h2>

                <div class="menu__container row bd-grid">
                    <?php 
                        require_once '../dao/DaoProduto.php';

                        try {
                            $produtos = DaoProduto::listar(1);
                        } catch(PDOException $e){
                            echo $e->getMessage();
                        }    

                        foreach($produtos as $produto){ ?>
                            <div class="col menu__content">
                                <img src="<?php echo '../'.$produto['fotoProduto']; ?>" alt="" class="menu__img">
                                <h3 class="menu__name"><?php echo $produto['nomeProduto']; ?></h3>
                                <span class="menu__detail"><?php echo $produto['marcaProduto']; ?></span>
                                <span class="menu__preci">R$ <?php echo number_format($produto['precoProduto'], 2, ',', '.'); ?></span>
                                <a href="produto-info.php?id=<?php echo $produto['codProduto']; ?>" class="button menu__button"><i class='bx bx-cart-alt'></i></a>
                            </div>
                        <?php } ?>
            
                </div>
                <div class="row menu__container bd-grid">
                    <div class="col">
                        
                    </div>
                    <div class="col"></div> 
                    <div class="col"><a class="nav-blue button align-center" href="produtos-fullCliente.php">Ver mais >></a></div>   
                </div>

                
            </section>

            <!-- CONTATO -->
            <section class="contact section bd-container" id="cadastro">
                <div class="contact__container bd-grid">
                    <div class="contact__data">
                        <span class="section-subtitle contact__initial">Quer receber novidades?</span>
                        <h2 class="section-title contact__initial">Cadastre-se para receber promoções/novidades:</h2>
                        <form name="forms" action="">
                            <div class="send__direction">
                                <input type="E-mail" placeholder="E-mail" class="send__input" id="E-mail">
                                <button type="button" class="button" onclick="validar()">Cadastrar</a>
                            </div>
                        </form>
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
                            <li><a href="loginAdm.php" class="footer__link">Área do administrador</a></li>
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