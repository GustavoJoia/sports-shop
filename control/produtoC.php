<?php
    require_once '../model/Produto.php';
    require_once '../model/Categoria.php';
    require_once '../model/Subcategoria.php';
    require_once '../dao/DaoProduto.php';

    $produto = new Produto();

    $produto->setNome($_POST['txt_nomeProduto']);
    $produto->setPreco($_POST['txt_valor']);

    $categoria = new Categoria();

    $categoria->setId($_POST['slt_categoria']);

    $produto->setCategoria($categoria);

    $subcategoria = new Subcategoria();

    //$subcategoria->setId($_POST['']);
    
    //cadastrando produto sem a foto
    DaoProduto::cadastrar($produto);

    $produto->setId(DaoProduto::consultarId($produto));

    //nome original do arquivo no computador do usuário
    $nome = $_FILES[''][''];

    //para validações que possam ser necessárias, na nossa loja não será origatório
    //$tipo =$_FILES['foto']['type']; exemplo image/gif
    //$tamanho = $_FILES['foto']['size']; tamanho em bytes

    //nome temporário do arquivo como foi armazenado no servidor, é o ARQUIVO!!!
    $arquivo = $_FILES[''][''];

    $diretorio = "assets/img/produtos/";
    
    $extensao = substr($nome, -4);//pega o ponto e os 3 caracteres da extensão do arquivo
    $nomenovo = $produto->getId().$extensao;

    $nomecompleto =  $diretorio.$nomenovo;

    move_uploaded_file($arquivo, "../".$nomecompleto);

    $produto->setFoto($nomecompleto);

    DaoProduto::atualizarFoto($produto);

?>