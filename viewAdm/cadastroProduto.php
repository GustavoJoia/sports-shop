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
        <title>ADM - Produtos</title>  
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
                <div class="li-back-ativo">
                    <li class="span__sidebar">Produtos</li>
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

        <main>
            <div class="card-flex">
                <a href="#cadastrados" class="nav-link button side nav-green">Produtos cadastradas</a>
            </div>
                <div class="card-body">
                 
                    <div class="home__container bd-container bd-grid">
                            <div class="home__data">
                                
                                <form id="form-produto" action="../control/cadastra-produto.php" method="post" enctype="multipart/form-data" style="margin-top: 40vh">
                                    <h2 class="home__subtitleAlt">Cadastro de produto</h2>
                                    <br>
                                        <div class="mb-3">
                                            <label>Nome do produto</label>
                                            <input type="text" name="nomeProduto" id="nomeProduto" class="form-control form-border" placeholder="Digite o nome do produto">
                                        </div>
                                        <div class="mb-3">
                                            <label>Quantidade em estoque:</label>
                                            <input type="text" name="estoqueProduto" id="estoqueProduto" class="form-control form-border" placeholder="Digite qual a quantidade em estoque desse produto">
                                        </div>
                                        <div class="mb-3">
                                            <label>Marca:</label>
                                            <input type="text" name="marcaProduto" id="marcaProduto" class="form-control form-border" placeholder="Digite a marca do produto">
                                        </div>
                                        <div class="mb-3">
                                            
                                            <label>Valor</label>
                                            <input type="text" name="valor" id="valor" class="form-control form-border" placeholder="Digite o valor do produto">
                                            <?php
                                                require_once '../dao/DaoCategoria.php';
                                                require_once '../dao/DaoSubcategoria.php';
                                                try {
                                                    $lista1 = DaoCategoria::listar(0);
                                                    $lista2 = DaoSubcategoria::listar();
                                                } catch(Exception $e) {
                                                    echo $e->getMessage();
                                                }
                                            ?>
                                            <label> Categoria </label>
                                            <select class="form-select form-select-sm" name="slt_categoria" id="slt_categoria" aria-label=".form-select-sm example">
                                                <option selected>Selecione a categoria...</option>
                                                <?php foreach($lista1 as $categoria){ ?>
                                                <option value="<?php echo $categoria['codCategoria'];?>">
                                                    <?php echo  $categoria['nomeCategoria'];?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <label> SubCategoria </label>
                                            <select class="form-select form-select-sm" name="slt_subcategoria" id="slt_subcategoria" aria-label=".form-select-sm example">
                                                <option selected>Selecione a subcategoria...</option>
                                                <?php foreach($lista2 as $subcategoria){ ?>
                                                <option value="<?php echo $subcategoria['codSubCategoria'];?>">
                                                    <?php echo  $subcategoria['nomeSubCategoria'];?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <div class="input-group mb-3">
                                                <input type="file" accept="image/*" name="foto" id="foto" class="form-control">
                                            </div>
                                        </div>
                                    <button type="submit" class="button" style="margin-bottom: 15vh">Cadastrar</a></button>
                                </form>       
                            </div>
                        <img src="../assets/img/Barcode-amico.png" alt="" class="about__img">
                    </div>

                    <h2 class="section-title-alt form-produto" style="margin-top: 35vh">Produtos cadastrados</h2>
                    <form class="formSearch">
                        <div class="heading__table">
                            <input class="form-control mr-sm-2" type="search" placeholder="Busque..." aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><span class="material-symbols-outlined">search</span></button>
                        </div>
                    </form>
                    <section class="section__cadastrados" id="cadastrados">
                        <table class="table">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Estoque</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Subcategoria</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            require_once "../dao/DaoProduto.php";
                            $produtos = DaoProduto::listar(0);
                            
                            foreach($produtos as $produto){ ?>
                                <tr>
                                    <th scope="row"><?php echo $produto['codProduto']; ?></th>
                                    <td> <img src="<?php echo '../'.$produto['fotoProduto']; ?>" class="rounded" width="20%"></td>
                                    <td class="align-middle"><?php echo $produto['nomeProduto']; ?></td>
                                    <td class="align-middle"><?php echo $produto['precoProduto']; ?> </td>
                                    <td class="align-middle"><?php echo $produto['estoqueProduto']; ?> </td>
                                    <td class="align-middle"><?php echo $produto['marcaProduto']; ?> </td>
                                    <td class="align-middle"><?php echo $produto['nomeCategoria']; ?> </td>
                                    <td class="align-middle"><?php echo $produto['nomeSubcategoria']; ?> </td>
                                    <td class="align-middle"><a href="edicaoProduto.php?id=<?php echo $produto['codProduto']; ?>" class="nav-green nav-color">Editar</a></td>
                                    <td class="align-middle"><a href="../control/excluir-produto.php?id=<?php echo $produto['codProduto']; ?>" class="nav-red nav-color">Excluir</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </section>

                </div>
            </div>    

        </main>

    </body>
</html>