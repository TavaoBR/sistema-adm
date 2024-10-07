<?php

namespace Src\Controller;
use Config\TemplateConfig;
use Src\Models\Usuario\Usuario;
use Src\Request\Usuario\Login;

class IndexController extends TemplateConfig{
    public function index(){
        $this->view("index", ["title" => "Index"]);
    }

    public function test(){

        $login = new Login;
        $login->Result();

       /*$usuario = new Usuario();
       $usuario->usuario = "wolverine";
       $usuario->senha = "Batman";
       $select = $usuario->ByName();

       if($select[0] == 0){
        echo "Dados invalidos";
       }

       $dados = $select[1];
       $usuario->id = $dados->id;
       $usuario->tentativas = $dados->tentativas;

       if($usuario->tentativas == 7){
          echo "Login Bloqueado";
       }elseif($dados->senha != md5($usuario->senha)){
         $soma = $usuario->tentativas + 1;
         $usuario->updateTentativas($soma);
         $tentativas = 5;
         $totalTentativasRestantes = $tentativas - $dados->tentativas;
         echo "Login Inválido. Restão apenas $totalTentativasRestantes";
       }else{
        $usuario->resetarTentativas();
        echo "Bem vindo";
       }*/



       /*if($select[0] > 0){
         $usuario->avatar = $select[1]->avatar;
         $path = routerConfig()."/Public/usuario/{$usuario->avatar}";
         echo "<img src='$path'>"; 
       }*/
       /*$usuario->usuario = "wolverine";
       $usuario->senha = "Batman";
       $usuario->viewSenha = "Batman";
       $usuario->tentativas = 1;
       $usuario->avatar = "07d1420abe8cb2fc4422970bdc8f5392.jpg";
       $create = $usuario->create();
       if($create[0] > 0){
         echo "ID :" .$create[1];
       }else{
        echo "Deu ruim";
       }*/

       
    }
}