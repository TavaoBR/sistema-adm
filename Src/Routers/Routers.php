<?php 

namespace Src\Routers;
use CoffeeCode\Router\Router;

class Routers {

    private $dominio;

    public function __construct(){
        $this->dominio = routerConfig();
    }

    private function startServer(){
        return new Router($this->dominio);
    }

    public function get(){
        $router = $this->startServer();

        $router->group(null)->namespace("Src\Controller");
        $router->get("/", "IndexController:index");
        $router->get("/test", "IndexController:test");

        $router->group("user")->namespace("Src\Controller\Usuario");
        $router->get("/login", "UController:login");

        $router->group("oops")->namespace("Src\Controller\Error");
        $router->get("/{errocode}", "EController:notFound");

        $router->dispatch();
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }
    }

    public function post(){
        $router = $this->startServer();

        $router->group("user")->namespace("Src\Request\Usuario");
        $router->post("/login", "Login:Result");

        $router->group("oops")->namespace("Src\Controller\Error");
        $router->get("/{errocode}", "EController:notFound");

        $router->dispatch();
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }
    }

}