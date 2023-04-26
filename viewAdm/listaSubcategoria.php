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
        <title>ADM - SubCategoria</title>
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
                    <li class="span__sidebar">Categorias</li>
                </div>
                <div class="li-back-ativo">
                    <a href="cadastroSubcategoria.php"><li class="span__sidebar">Sub-Categorias</li></a>
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
                            <a href="listaCategoria.php" class="nav-link nav-green">Categorias cadastradas</a>
                        </li>
                        <li class="nav-item">
                            <a href="cadastroCategoria.php" class="nav-link nav-green">Cadastrar categoria</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    
                
                </div>
            </div> 

            <h2 class="section-title-alt form-produto" style="margin-top: 10vh">SubCategorias cadastradas</h2>
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
                            <th scope="col">Nome da subcategoria</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            require_once "../dao/DaoSubcategoria.php";
                            $subcategorias = DaoSubcategoria::listar();
                            
                            foreach($subcategorias as $subcategoria){ ?>
                                <tr>
                                    <th class="align-middle" scope="row"><?php echo $subcategoria['codSubCategoria']; ?></th>
                                    <td> <img src="<?php echo '../'.$subcategoria['fotoSubCategoria']; ?>" class="rounded" width="20%"></td>
                                    <td class="align-middle"><?php echo $subcategoria['nomeSubCategoria']; ?></td>
                                    <td class="align-middle"><?php echo $subcategoria['descSubCategoria']; ?> </td>
                                    <td class="align-middle"><a href="edicaoSubcategoria.php?id=<?php echo $subcategoria['codSubCategoria']; ?>" class="nav-green nav-color">Editar</a></a>
                                    <td class="align-middle"><a href="../control/excluir-subcategoria.php?id=<?php echo $subcategoria['codSubCategoria']; ?>" class="nav-red nav-color">Excluir</a></a>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </section>
        </main>

    </body>
</html>