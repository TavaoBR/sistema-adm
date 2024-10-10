<?php 

namespace Src\Request;

class Validate {

    public function validate(array $request)
    {

        $html = "<ol>"; 
        
        $camposEmBranco = false;
        
        foreach($request as $data => $value){
         
            if(!isset($value) || empty($value)){
                $camposEmBranco = true;
                $html .= "
                    <li>O CAMPO <strong>'$data'</strong> está em branco. Por favor, preencha esse campo.<br></li>
                ";
            }
        }

        $html .= "</ol>";

        if($camposEmBranco){
            
            return $html;
        }
            
        
        return false;

    }


    public function validarSenha(string $senha)
    {

            // Pelo menos 8 caracteres
            // Pelo menos uma letra maiúscula
            // Pelo menos uma letra minúscula
            // Pelo menos um número
            // Pelo menos um caractere especial

            $regEx = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

            if(preg_match($regEx, $senha)){
               
                return true;
            }

               return false;

    }

}