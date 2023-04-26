<?php 

    session_start();
    
    // include("valida-permanencia.php");
    include_once("../control/valida-permanencia.php");

    require_once '../dao/DaoProduto.php';
    require_once '../model/Produto.php';

    $id = $_GET['id'];
    $produto = new Produto();
    $produto->setId($id);
    $lista = DaoProduto::listarEspecifico($produto);

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
        <title>ADM - Editar Produto</title>  
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
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                 
                    <div class="home__container bd-container bd-grid">
                            <div class="home__data">
                                
                                <form id="form-produto" action="../control/edita-produto.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" style="margin-top: 40vh">
                                    <h2 class="home__subtitleAlt">Editando: <?php echo $lista['nomeProduto']; ?></h2>
                                    <p>O campo que não for preenchido será mantido conforme valor da última atualização</p>
                                    <br>
                                        <div class="mb-3">
                                            <label>Nome do produto:</label>
                                            <input type="text" name="nomeProduto" id="nomeProduto" class="form-control form-border" placeholder="<?php echo $lista['nomeProduto']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Quantidade em estoque:</label>
                                            <input type="text" name="estoqueProduto" id="estoqueProduto" class="form-control form-border" placeholder="<?php echo $lista['estoqueProduto']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label>Marca:</label>
                                            <input type="text" name="marcaProduto" id="marcaProduto" class="form-control form-border" placeholder="<?php echo $lista['marcaProduto']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            
                                            <label>Valor</label>
                                            <input type="text" name="valor" id="valor" class="form-control form-border" placeholder="<?php echo $lista['precoProduto']; ?>">
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
                                                <option value="" selected>Selecione a categoria...</option>
                                                <?php foreach($lista1 as $categoria){ ?>
                                                <option value="<?php echo $categoria['codCategoria'];?>">
                                                    <?php echo  $categoria['nomeCategoria'];?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <label> SubCategoria </label>
                                            <select class="form-select form-select-sm" name="slt_subcategoria" id="slt_subcategoria" aria-label=".form-select-sm example">
                                                <option value="" selected>Selecione a subcategoria...</option>
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
                                    <div class="row">
                                        <div class="col"><button type="submit" class="button" style="margin-bottom: 15vh">Atualizar</a></button></div>
                                        <div class="col"></div>
                                        <div class="col"><a class="nav-link button btn-cancelar nav-red" href="cadastroProduto.php#cadastrados">Cancelar</a></div>
                                    </div>
                                </form>       
                            </div>
                    </div>

                </div>
            </div>    

        </main>

    </body>
</html>