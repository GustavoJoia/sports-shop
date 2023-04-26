<?php 
    header('Location: ../viewAdm/cadastroProduto.php#cadastrados');

    require_once '../model/Produto.php';
    require_once '../dao/DaoProduto.php';
    require_once '../model/Categoria.php';
    require_once '../model/Subcategoria.php';

    $produto = new Produto;
    $categoria = new Categoria();
    $subcategoria = new Subcategoria();

    $produto->setId($_GET['id']);
    $valorAtual = DaoProduto::listarEspecifico($produto);
    $nomeProduto = $_POST['nomeProduto'];
    $estoqueProduto = $_POST['estoqueProduto'];
    $marcaProduto = $_POST['marcaProduto'];
    $precoProduto = $_POST['valor'];
    $categoriaProduto = $_POST['slt_categoria'];
    $subcategoriaProduto = $_POST['slt_subcategoria'];

    if($nomeProduto == ''){
        $produto->setNome($valorAtual['nomeProduto']);
    } else {
        $produto->setNome($nomeProduto);
    }
    if($estoqueProduto == ''){
        $produto->setEstoque($valorAtual['estoqueProduto']);
    } else {
        $produto->setEstoque($estoqueProduto);
    }
    if($marcaProduto == ''){
        $produto->setMarca($valorAtual['marcaProduto']);
    } else {
        $produto->setMarca($marcaProduto);
    }
    if($precoProduto == ''){
        $produto->setPreco($valorAtual['precoProduto']);
    } else {
        $produto->setPreco($precoProduto);
    }
    if($categoriaProduto == ''){
        $categoria->setId($valorAtual['codCategoria']);
        $produto->setCategoria($categoria);
    } else {
        $categoria->setId($categoriaProduto);
        $produto->setCategoria($categoria);
    }
    if($subcategoriaProduto == ''){
        $subcategoria->setId($valorAtual['codSubCategoria']);
        $produto->setSubcategoria($subcategoria);
    } else {
        $subcategoria->setId($subcategoriaProduto);
        $produto->setSubcategoria($subcategoria);
    }

    $nome = $_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamanho = $_FILES['foto']['size'];
    $arquivo = $_FILES['foto']['tmp_name'];
    echo $tamanho;

    if($tamanho == '0'){
        $produto->setFoto($valorAtual['fotoProduto']);
    } else {
          
        unlink('../'.$valorAtual['fotoProduto']);
        
        
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
    }  
    DaoProduto::atualizar($produto);

?>