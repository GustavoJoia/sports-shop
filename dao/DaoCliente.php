<?php
    require_once '../model/Cliente.php';
    require_once '../model/Conexao.php';

    class DaoCliente{

        public static function cadastrar($cliente){
            $conexao = Conexao::conectar();

            $insert = "INSERT INTO tbCliente(nomeCliente, cpfCliente, emailCliente, senhaCliente, logradouroCliente, numLogCliente, complCliente, bairroCliente, cidadeCliente, ufCliente, cepCliente)
                            VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            
            $prepareStatement = $conexao->prepare($insert);
            
            $prepareStatement->bindValue(1, $cliente->getNome());
            $prepareStatement->bindValue(2, $cliente->getCpf());
            $prepareStatement->bindValue(3, $cliente->getEmail());
            $prepareStatement->bindValue(4, $cliente->getSenha());
            $prepareStatement->bindValue(5, $cliente->getLogradouro());
            $prepareStatement->bindValue(6, $cliente->getNumLog());
            $prepareStatement->bindValue(7, $cliente->getComp());
            $prepareStatement->bindValue(8, $cliente->getBairro());
            $prepareStatement->bindValue(9, $cliente->getCidade());
            $prepareStatement->bindValue(10, $cliente->getUf());
            $prepareStatement->bindValue(11, $cliente->getCep());

            $prepareStatement->execute();
        }

        public static function atualizar($cliente){
            $conexao = Conexao::conectar();

            $update = 'UPDATE tbCliente SET nomeCliente = ?, cpfCliente = ?, emailCliente = ?, senhaCliente = ?
            logradouroCliente = ?, numLogCliente = ?, compCliente = ?, bairroCliente = ?, cidadeCliente = ?
            ,ufCliente = ?, cepCliente = ? 
            WHERE idCliente = ?';

            $prepareStatement = $conexao->prepare($update);
            $prepareStatement->bindValue(1, $cliente->getNome());
            $prepareStatement->bindValue(2, $cliente->getCpf());
            $prepareStatement->bindValue(3, $cliente->getEmail());
            $prepareStatement->bindValue(4, $cliente->getSenha());
            $prepareStatement->bindValue(5, $cliente->getLogradouro());
            $prepareStatement->bindValue(6, $cliente->getNumLog());
            $prepareStatement->bindValue(7, $cliente->getComp());
            $prepareStatement->bindValue(8, $cliente->getBairro());
            $prepareStatement->bindValue(9, $cliente->getCidade());
            $prepareStatement->bindValue(10, $cliente->getUf());
            $prepareStatement->bindValue(11, $cliente->getCep());
            $prepareStatement->bindValue(12, $cliente->getId());

            $prepareStatement->execute();
        }

        public static function listar(){
            $conexao = Conexao::conectar();

            $select = "SELECT codCliente, nomeCliente, cpfCliente, emailCliente, logradouroCliente, numLogCliente, cepCliente, complCliente, bairroCliente, cidadeCliente, ufCliente FROM tbCliente";
            $resultado = $conexao->query($select);
            $lista = $resultado->fetchAll();
            return $lista;
        }

        public static function excluir($cliente){
            $conexao = Conexao::conectar();

            // explicar em aula minha ideia alternativa
            $delete = 'DELETE FROM tbCliente WHERE idCliente = ?';

            $prepareStatement = $conexao->prepare($delete);

            $prepareStatement->bindValue(1, $cliente->getId());
            $prepareStatement->execute();

        }

        // procurar por email
        public static function procurarPorEmail($email){
            $conexao = Conexao::conectar();

            $select = 'SELECT * FROM tbCliente WHERE emailCliente = ?';

            $prepareStatement = $conexao->prepare($select);

            $prepareStatement->bindValue(1, $email->getEmail());

            $prepareStatement->execute();

            $cliente = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            if($cliente != null){
                return true;
            }
        }

        // procurar por cpf
        public static function procurarPorCpf(Cliente $cliente){
            $conexao = Conexao::conectar();

            $select = 'SELECT * FROM tbCliente WHERE cpfCliente = ?';

            $prepareStatement = $conexao->prepare($select);

            $prepareStatement->bindValue(1, $cliente->getCpf());	

            $prepareStatement->execute();

            $cliente = $prepareStatement->fetch(PDO::FETCH_ASSOC);
            if($cliente != null){
                return true;
            }
        }

        public static function login($cliente){

            $conexao = Conexao::conectar();
            $select = 'SELECT COUNT(codCliente) AS contagem FROM tbCliente
                       WHERE emailCliente LIKE ? AND senhaCliente LIKE ?';

            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $cliente->getEmail());
            $prepare->bindValue(2, $cliente->getSenha());
            $prepare->execute();

            $lista = $prepare->fetch(PDO::FETCH_ASSOC);
            $contagem = $lista['contagem'];

            if($contagem >= 1){
                return true;
            } else {
                return false;
            }

        }

        public static function consultarId($cliente){

            $conexao = Conexao::conectar();
            $select = 'SELECT codCliente FROM tbCliente WHERE emailCliente LIKE ? AND senhaCliente LIKE ?';

            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $cliente->getEmail());
            $prepare->bindValue(2, $cliente->getSenha());
            $prepare->execute();

            $lista = $prepare->fetch(PDO::FETCH_ASSOC);
            $id = $lista['codCliente'];

            return $id;

        }

        public static function buscarDados($cliente){

            $conexao = Conexao::conectar();
            $select = 'SELECT nivelAcesso, nomeCliente, cpfCliente, emailCliente, senhaCliente, logradouroCliente, numLogCliente, complCliente, bairroCliente, cidadeCliente, ufCliente, cepCliente, ultimoLoginCliente
                       FROM tbCliente
                       WHERE codCliente = ?';
            
            $prepare = $conexao->prepare($select);
            $prepare->bindValue(1, $cliente->getId());
            $prepare->execute();

            $lista = $prepare->fetch(PDO::FETCH_ASSOC);
            
            return $lista;

        }

        public static function contarClientes(){

            $conexao = Conexao::conectar();
            $select = 'SELECT COUNT(codCliente) AS qtde FROM tbCliente';
            $resultado = $conexao->query($select);
            
            $lista = $resultado->fetchAll();

            foreach($lista as $num){
                return $num['qtde'];
            }    

        }


    }
?>