<?php 

namespace Src\Request\Usuario;

use Src\Models\Usuario\Usuario;

class Login {

    private Usuario $user;

    public function __construct(){
        $this->user = new Usuario;
        $this->user->usuario = $_POST['usuario'];
        $this->user->senha = $_POST['senha'];
    }

    public function Result(){

    }

    private function request(){
     
    }

    private function login(){

    }

}