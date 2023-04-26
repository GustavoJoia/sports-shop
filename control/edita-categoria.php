<?php 

    header('Location: ../viewAdm/cadastroCategoria.php#cadastrados');

    require_once '../model/Categoria.php';
    require_once '../dao/DaoCategoria.php';

    $categoria = new Categoria();

    $categoria->setId($_GET['id']);
    $valorAtual = DaoCategoria::listarEspecifico($categoria);
    $nomeSub = $_POST['txt_nomeCategoria'];
    $descSub = $_POST['txt_descCategoria'];

    if($nomeSub == ''){
        $categoria->setNome($valorAtual['nomeCategoria']);
    } else {
        $categoria->setNome($nomeSub);
    }
    if($descSub == ''){
        $categoria->setDescricao($valorAtual['descCategoria']);
    } else {
        $categoria->setDescricao($descSub);
    }

    $nome = $_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamanho = $_FILES['foto']['size'];
    $arquivo = $_FILES['foto']['tmp_name'];

    if($tamanho == '0'){
        $categoria->setFoto($valorAtual['fotoCategoria']);
    } else {
        unlink('../'.$valorAtual['fotoCategoria']);
        if($tipo == 'image/webp'){
            $extensao = substr($nome, -5);
        } else {
            $extensao = substr($nome, -4);
        }
        $nomenovo = $categoria->getId().$extensao;
        $diretorio = "assets/img/categorias/";
        $nomecompleto =  $diretorio.$nomenovo;

        move_uploaded_file($arquivo, '../'.$nomecompleto);

        $categoria->setFoto($nomecompleto);
    }    
    
    DaoCategoria::atualizar($categoria);

?>