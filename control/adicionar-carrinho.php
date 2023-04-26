<?php

    require_once '../model/Produto.php';
    require_once '../dao/DaoProduto.php';
    require_once '../model/ItemVenda.php';
    require_once '../model/Categoria.php';
    require_once '../model/Subcategoria.php';
    require_once '../dao/DaoCategoria.php';
    require_once '../dao/DaoSubcategoria.php';

    session_start();

    $id = $_GET['id'];

    $produto = new Produto();
    $categoria = new Categoria();
    $subcategoria = new Subcategoria();
    $produto->setId($id);
    $p = DaoProduto::listarEspecifico($produto);
    $categoria->setId($p['codCategoria']);
    $subcategoria->setId($p['codSubCategoria']);
    $c = DaoCategoria::listarEspecifico($categoria);
    $s = DaoSubcategoria::listarEspecifico($subcategoria);
                
    $produto->setPreco($p['precoProduto']);
    $produto->setNome($p['nomeProduto']);
    $produto->setMarca($p['marcaProduto']);
    $produto->setEstoque($p['estoqueProduto']);
    $produto->setFoto($p['fotoProduto']);

    $categoria->setNome($c['nomeCategoria']);
    $categoria->setDescricao($c['descCategoria']);
    $categoria->setFoto($c['fotoCategoria']);

    $subcategoria->setNome($s['nomeSubCategoria']);
    $subcategoria->setDescricao($s['descSubCategoria']);
    $subcategoria->setFoto($s['fotoSubCategoria']);

    $produto->setCategoria($categoria);
    $produto->setSubcategoria($subcategoria);
    
  
    $item = new ItemVenda();
    $item->setQtde(1);
    $item->setProduto($produto);
    $item->setSubtotal($item->getQtde() * $item->getProduto()->getPreco());

    if (isset($_SESSION["carrinho"])){
        header("Location: ../viewCliente/produto-info.php?id=".$id);

        $carrinhorecebido =  $_SESSION["carrinho"];
        $carrinhoAtual = unserialize($carrinhorecebido);

        $idRepetido;

        foreach($carrinhoAtual as $idVetorCarrinho => $itemCarrinho){

            if($itemCarrinho->getProduto()->getId() == $item->getProduto()->getId()){
                $idRepetido = $idVetorCarrinho;
            }
        }

        if (isset($idRepetido)) {
            $item->setQtde($itemCarrinho->getQtde() + 1);
            $item->setSubtotal($item->getQtde() * $item->getProduto()->getPreco());
            $carrinhoAtual[$idVetorCarrinho] = $item;
            $carrinhoSalvo = serialize($carrinhoAtual);
            $_SESSION['carrinho'] = $carrinhoSalvo;

            
        } else {
            $carrinhoAtual[] = $item;
            $carrinhoSalvo = serialize($carrinhoAtual);
            $_SESSION['carrinho'] = $carrinhoSalvo;
        }
        

        // echo 'já tem carrinho <br> <pre>';
        //     print_r($carrinhoAtual);
        // echo '</pre>';
    }
    else{
        header("Location: ../viewCliente/produto-info.php?id=".$id);
        $carrinho = array();

        $carrinho[] = $item;
        
        $carrinhoSalvo = serialize($carrinho);
        $_SESSION['carrinho'] = $carrinhoSalvo;

        
        // echo 'criou carrinho <br> <pre>';
        //     print_r($carrinho);
        // echo '</pre>';
    }

?>