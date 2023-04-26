<?php 

//Model
require_once '../model/Cliente.php';
$Cliente = new Cliente();

//DAO
require_once '../dao/DaoCliente.php';
$ClienteDAO = new DaoCliente();

//Controller
require_once '../control/ClienteController.php';
$ClienteController = new ClienteController();

//Necessario para validação.
$Cliente->setCpf($_POST['cpfcliente']);
    $Cliente->setCpf($ClienteController->formatarCPF($Cliente));
$Cliente->setEmail($_POST['emailcliente']);



if($ClienteController->validarCPF($Cliente) == True){
echo "CPF Válido<br>";

    if($ClienteDAO->procurarPorCpf($Cliente)){
        echo "Não foi possivel efetuar cadastro. <br> ERRO: CPF já cadastrado.<br>";
    }
    else{
        if($ClienteDAO->procurarPorEmail($Cliente) == True || $ClienteController->validarEmail($Cliente) == False){
            echo "Não foi possivel efetuar cadastro. <br> ERRO: Email já cadastrado / Email invalido.<br>";
        } else{
            $Cliente->setNome($_POST['nomecliente']);
            $Cliente->setSenha($_POST['senhacliente']);
            $Cliente->setLogradouro($_POST['logradourocliente']);
            $Cliente->setCep($_POST['cepcliente']);
                $Cliente->setCep($ClienteController->formatarCep($Cliente));
            $Cliente->setNumLog($_POST['numlogcliente']);
            $Cliente->setComp($_POST['complementocliente']);
            $Cliente->setBairro($_POST['bairrocliente']);
            $Cliente->setCidade($_POST['cidadecliente']);
            $Cliente->setUf($_POST['ufcliente']);
            $ClienteDAO->cadastrar($Cliente);
            echo "Cadastro efetuado com sucesso!<br>";
            
        }
    }

}else{
echo "CPF Inválido<br>";
}

?>