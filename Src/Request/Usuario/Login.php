<?php 

namespace Src\Request\Usuario;

use Config\TokenUser;
use Src\Models\Usuario\Usuario;
use Src\Request\Validate;

class Login {

    private Usuario $user;
    private Validate $validate;
    public function __construct(){
        $this->user = new Usuario;
        $this->validate = new Validate;
        $this->user->usuario = $_POST['name'];
        $this->user->senha = $_POST['senha'];
    }

    public function Result(): void{
        session_start();
        if(!$this->request()){
          $this->login();
        }
    }

    private function request(): bool{
       $data = [
           "Nome de Usuario" => $this->user->usuario,
           "Senha" => $this->user->senha
       ];

       if($this->validate->validate($data) != false){
        setSessions(["MensagemLogin" => messageWarning($this->validate->validate($data)), "loginUser" => $this->user->usuario, "loginSenha" => $this->user->senha]);
        redirectBack();
        return true;
       }

       return false;
    }

    private function login(){
        $select = $this->user->ByName();
        if($select[0] == 0){
            setSessions(["MensagemLogin" => sweetAlertError("Dados invalidos"), "loginUser" => $this->user->usuario, "loginSenha" => $this->user->senha]);
            redirectBack();
        }

        $dados = $select[1];
        $this->user->id = $dados->id;
        $this->user->tentativas = $dados->tentativas;

        switch(true){
           
            case $this->user->tentativas == 5:
                setSessions(["MensagemLogin" => sweetAlertError("Login Bloqueado"), "loginUser" => $this->user->usuario, "loginSenha" => $this->user->senha]);
                redirectBack();
            break;    

            case $dados->senha != md5($this->user->senha):
               $soma = $this->user->tentativas + 1;
               $this->user->updateTentativas($soma);
               $tentivas = 5;
               $tentivasRestantes = $tentivas - $dados->tentativas;
               setSessions(["MensagemLogin" => sweetAlertError("Login Inválido. Restão apenas $tentivasRestantes"), "loginUser" => $this->user->usuario, "loginSenha" => $this->user->senha]);
               redirectBack();
            break;
            
            default:
               $this->user->resetarTentativas();
               $this->token($this->user->id);
               $this->user->token = $dados->token;
               $this->criarSessao($this->user->id, $this->user->token);
               viewSession("id");
               echo "<br>";
               viewSession("token");
            break;
        }

    }

    private function token(int $id){
        $token = new TokenUser($id);
        $token->token();
     }

    private function criarSessao($id, $token): array   {
        return setSessions(["id" => $id, "token" => $token]);
    }

}