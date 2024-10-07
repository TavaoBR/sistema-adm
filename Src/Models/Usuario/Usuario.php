<?php 

namespace Src\Models\Usuario;

use Src\Database\Migration\Usuario as User;

class Usuario {

    public int $id;
    public string $usuario;
    public string $senha;
    public string $viewSenha;
    public string $permissoes;
    public string $avatar;
    public int $tentativas;
    public string $token;
    private User $user;

    public function __construct(){
        $this->user = new User;
    }

    public function create(): array{
       $create = $this->user->create([
         "usuario" => $this->usuario,
         "senha" => md5($this->senha),
         "viewSenha" => $this->viewSenha,
         "tentativas" => $this->tentativas,
         "avatar" => $this->avatar
       ]);

       return $create;
    }

    public function updateTentativas($tentativas): void{
        $this->user->update("id", $this->id, ["tentativas" => $tentativas]);
    }

    public function resetarTentativas(){
        $this->user->update("id", $this->id, ["tentativas" => "1"]);
    }

    public function ById(): array{
        return $this->user->findBy("id", $this->id);
    }

    public function ByToken(): array{
        return $this->user->findBy("token", $this->token);
    }

    public function ByName(): array{
        return $this->user->findBy("usuario", $this->usuario);
    }

    public function All(): array{
        return $this->user->fetchAll();
    }

}