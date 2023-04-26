<?php 
    session_start();
    
    // include("valida-permanencia.php");
    include_once("../control/valida-permanencia.php");
    // require("valida-permanencia.php");
    // require_once("valida-permanencia.php");

    require_once '../model/Categoria.php';
    require_once '../dao/DaoCategoria.php';

    $id = $_GET['id'];
    $categoria = new Categoria();
    $categoria->setId($id);
    $lista = DaoCategoria::listarEspecifico($categoria);
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
        <title>ADM - Editar Categoria</title>
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
                <div class="li-back-ativo">
                    <li class="span__sidebar">Categorias</li>
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
                                <h2 class="home__subtitleAlt">Editando: <?php echo $lista['nomeCategoria']; ?></h2>
                                <p>O campo que não for preenchido será mantido conforme valor da última atualização</p>
                                    <br>
                                    <form name="formularioProduto" action="../control/edita-categoria.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label>Nome da Categoria:</label>
                                            <input type="text" name=txt_nomeCategoria class="form-control form-border" id="formGroupExampleInput" placeholder="<?php echo $lista['nomeCategoria']; ?>">
                                            <label>Breve Descrição:</label>
                                            <input type="text" name=txt_descCategoria class="form-control form-border" id="formGroupExampleInput" placeholder="<?php echo $lista['descCategoria']; ?>"> 
                                            <div class="input-group mb-3">
                                            <input type="file" accept="image/*" name="foto" id="foto" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><button type="submit" class="button" style="margin-bottom: 15vh">Atualizar</a></button></div>
                                            <div class="col"></div>
                                            <div class="col"><a class="nav-link button btn-cancelar nav-red" href="cadastroCategoria.php#cadastrados">Cancelar</a></div>
                                        </div>
                                    </form>       
                            </div>
                    </div>
                </div>
            </div>    
        </main>

    </body>
</html>