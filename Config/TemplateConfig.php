<?php

namespace Config;

use Exception;
use League\Plates\Engine;

abstract class TemplateConfig {

    protected function view($view, $data = []){
       $path = "Web/$view.php";
       
       if(!file_exists($path)){
        throw new Exception("A view {$view} não existe");
       }

       $render = new Engine("Web");
       echo $render->render($view, $data);
    }

}