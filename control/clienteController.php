<?php 
    require_once '../model/Cliente.php';
    
    class ClienteController{
        
        //verificar cpf
        public function validarCPF(Cliente $a){
            $cpf = $a->getCpf();
    
            // Extrai somente os números
            $cpf = str_replace(".","",$cpf);
            $cpf = str_replace("-","",$cpf);
            
            $vetorCpf = array();
        
            for($i = 0; $i < ( strlen($cpf) ); $i++){ 
                $vetorCpf[$i] = substr($cpf,$i,1); 
            }
        
            //Primeiro dígito
            $contador = 10;
            $soma1 = 0;
            for($i = 0; $i < 9; $i++){
                $soma1 = $soma1 + ($vetorCpf[$i] * $contador);
                $contador--;
            }
            $digito1 = ($soma1 % 11);
            if ($digito1 < 2){
                $digito1 = 0;
            }
            else{
                $digito1 = 11 - $digito1;
            }
        
            //Segundo dígito
            $contador = 11;
            $soma2 = 0;
            for($i = 0; $i < 10; $i++){
                $soma2 = $soma2 + ($vetorCpf[$i] * $contador);
                $contador--;
            }
            $digito2 = ($soma2 % 11);
            if ($digito2 < 2){
                $digito2 = 0;
            }
            else{
                $digito2 = 11 - $digito2;
            }
        
            //Verifica se o CPF é válido
            if(($digito1 == $cpf[9]) && ($digito2 == $cpf[10])) {
                return true;
            } else {
                return false;
            }
    
        }

        //retirar . e - do cpf e adicionar . e - no cpf a cada 3 digitos
        public function formatarCPF(Cliente $a){
            $cpf = $a->getCpf();
            $cpf = str_replace(".","",$cpf);
            $cpf = str_replace("-","",$cpf);
            $cpf = str_replace(" ","",$cpf);
            $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
            $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
            return $cpf;

        }

        //retirar - do cep e adicionar - no cep apos 5 digitos
        public function formatarCEP(Cliente $a){
            $cep = $a->getCep();
            $cep = str_replace("-","",$cep);
            $cep = str_replace(" ","",$cep);
            $cep = str_pad($cep, 8, '0', STR_PAD_LEFT);
            $cep = substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
            return $cep;
        }

        //verificar email
        public function validarEmail(Cliente $a){
            $email = $a->getEmail();
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        }

    }
?>