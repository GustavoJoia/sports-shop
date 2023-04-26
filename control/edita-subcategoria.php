<?php 

    header('Location: ../viewAdm/cadastroSubcategoria.php#cadastrados');

    require_once '../model/Subcategoria.php';
    require_once '../dao/DaoSubcategoria.php';

    $subcategoria = new Subcategoria();

    $subcategoria->setId($_GET['id']);
    $valorAtual = DaoSubcategoria::listarEspecifico($subcategoria);
    $nomeSub = $_POST['txt_nomeCategoria'];
    $descSub = $_POST['txt_descCategoria'];

    if($nomeSub == ''){
        $subcategoria->setNome($valorAtual['nomeSubCategoria']);
    } else {
        $subcategoria->setNome($nomeSub);
    }
    if($descSub == ''){
        $subcategoria->setDescricao($valorAtual['descSubCategoria']);
    } else {
        $subcategoria->setDescricao($descSub);
    }

    $nome = $_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamanho = $_FILES['foto']['size'];
    $arquivo = $_FILES['foto']['tmp_name'];

    if($tamanho == '0'){
        $subcategoria->setFoto($valorAtual['fotoSubCategoria']);
    } else {
        unlink('../'.$valorAtual['fotoSubCategoria']);
        if($tipo == 'image/webp'){
            $extensao = substr($nome, -5);
        } else {
            $extensao = substr($nome, -4);
        }
        $nomenovo = $subcategoria->getId().$extensao;
        $diretorio = "assets/img/subcategorias/";
        $nomecompleto =  $diretorio.$nomenovo;

        move_uploaded_file($arquivo, '../'.$nomecompleto);

        $subcategoria->setFoto($nomecompleto);
    }    
    
    DaoSubcategoria::atualizar($subcategoria);

?>