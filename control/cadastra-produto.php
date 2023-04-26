<?php
    require_once '../model/Produto.php';
    require_once '../model/Categoria.php';
    require_once '../model/Subcategoria.php';
    require_once '../dao/DaoProduto.php';

    header('Location: ../viewAdm/cadastroProduto.php#cadastrados');

    $produto = new Produto();
    $categoria = new Categoria();
    $subcategoria = new Subcategoria();

    $produto->setNome($_POST['nomeProduto']);
    $produto->setEstoque($_POST['estoqueProduto']);
    $produto->setMarca($_POST['marcaProduto']);
    $produto->setPreco($_POST['valor']);
    $categoria->setId($_POST['slt_categoria']);
    $produto->setCategoria($categoria);
    $subcategoria->setId($_POST['slt_subcategoria']);
    $produto->setSubcategoria($subcategoria);
    
    //cadastrando produto sem a foto
    DaoProduto::cadastrar($produto);

    $produto->setId(DaoProduto::consultarId($produto));

    //nome original do arquivo no computador do usuário
    $nome = $_FILES['foto']['name'];

    //para validações que possam ser necessárias, na nossa loja não será origatório
    $tipo = $_FILES['foto']['type'];
    //$tamanho = $_FILES['foto']['size']; tamanho em bytes

    //nome temporário do arquivo como foi armazenado no servidor, é o ARQUIVO!!!
    $arquivo = $_FILES['foto']['tmp_name'];
    
    if($tipo == 'image/webp'){
        $extensao = substr($nome, -5);
    } else {
        $extensao = substr($nome, -4);
    }
    $nomenovo = $produto->getId().$extensao;
    $diretorio = "assets/img/produtos/";
    $nomecompleto =  $diretorio.$nomenovo;

    move_uploaded_file($arquivo, '../'.$nomecompleto);

    $produto->setFoto($nomecompleto);
    
    DaoProduto::atualizarFoto($produto);

?>