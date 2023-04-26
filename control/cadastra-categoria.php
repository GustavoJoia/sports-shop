<?php 

    require_once '../model/Categoria.php';
    require_once '../dao/DaoCategoria.php';
    require_once '../model/Subcategoria.php';
    require_once '../dao/DaoSubcategoria.php';

    header('Location: ../viewAdm/cadastroCategoria.php#cadastrados');

    $nomeC = $_POST['txt_nomeCategoria'];
    $descricaoC = $_POST['txt_descCategoria'];
    
        $categoria = new Categoria();

        $categoria->setNome($nomeC);
        $categoria->setDescricao($descricaoC);

        DaoCategoria::cadastrar($categoria);

        $categoria->setId(DaoCategoria::consultarId($categoria));

        $nome = $_FILES['foto']['name'];
        $tipo = $_FILES['foto']['type'];
        
        if($tipo == 'image/webp'){
            $extensao = substr($nome, -5);
        } else {
            $extensao = substr($nome, -4);
        }

        $arquivo = $_FILES['foto']['tmp_name'];

        $nomenovo = $categoria->getId().$extensao;
        $diretorio = "assets/img/categorias/";
        $nomecompleto =  $diretorio.$nomenovo;

        move_uploaded_file($arquivo, '../'.$nomecompleto);

        $categoria->setFoto($nomecompleto);
        
        DaoCategoria::atualizarFoto($categoria);

?>