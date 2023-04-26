<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- BOX ICONS-->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="../assets/css/styles.css">
        <script type="" src="../assets/js/main.js"></script>
        <title>SportShop - Administrador</title>
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

            <!-- CONTATO -->
            <section class="contact section bd-container" id="cadastro">
                <div class="contact__container bd-grid">
                    <div class="contact__data">
                        <span class="section-subtitle contact__initial">Apenas para administradores</span>
                        <h2 class="section-title contact__initial">Login</h2>
                        <form name="forms" method="POST" action="../control/valida-acesso.php">

                            <div class="mb-3">
                                <div class="send__direction">
                                        <input type="E-mail" placeholder="Usuário" class="send__input" name="txt_loginAdm" id="txt_loginAdm">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="send__direction">
                                    <input type="password" placeholder="Senha" class="send__input" name="txt_senhaAdm" id="txt_senhaAdm">
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="button" onclick="validar()">Entrar</a>
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