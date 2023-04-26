<?php 

    require_once '../model/Categoria.php';
    require_once '../dao/DaoCategoria.php';
    require_once '../model/Subcategoria.php';
    require_once '../dao/DaoSubcategoria.php';

    header('Location: ../viewAdm/cadastroSubcategoria.php#cadastrados');

    $nomeC = $_POST['txt_nomeCategoria'];
    $descricaoC = $_POST['txt_descCategoria'];

        $subcategoria = new Subcategoria();

        $subcategoria->setNome($nomeC);
        $subcategoria->setDescricao($descricaoC);

        DaoSubcategoria::cadastrar($subcategoria);

        $subcategoria->setId(DaoSubcategoria::consultarId($subcategoria));

        $nome = $_FILES['foto']['name'];
        $tipo = $_FILES['foto']['type'];
        
        if($tipo == 'image/webp'){
            $extensao = substr($nome, -5);
        } else {
            $extensao = substr($nome, -4);
        }

        $arquivo = $_FILES['foto']['tmp_name'];
        
        $nomenovo = $subcategoria->getId().$extensao;
        $diretorio = "assets/img/subcategorias/";
        $nomecompleto =  $diretorio.$nomenovo;

        move_uploaded_file($arquivo, '../'.$nomecompleto);

        $subcategoria->setFoto($nomecompleto);

        DaoSubcategoria::atualizarFoto($subcategoria); 

?>