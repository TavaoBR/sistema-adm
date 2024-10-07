<?php 

namespace Src\Request\Usuario;

use Src\Models\Usuario\Usuario;

class Registro {

    private Usuario $usuario;

    public function __construct(){
        $this->usuario = new Usuario;
    }

}