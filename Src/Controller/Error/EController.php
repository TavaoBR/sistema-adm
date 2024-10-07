<?php 

namespace Src\Controller\Error;

use Config\TemplateConfig;
class EController extends TemplateConfig{

    public function notfound($data){
        switch($data['errocode']){
          
            
          case "400":
            $this->error400();
          break;

          case "403":
            $this->error403();
          break;


            case "404":
               $this->error404();
            break; 

            case "405":
                $this->error405();
            break;  
 
            case "500":
               $this->error500();
            break; 
        }
     }
 
 
     private function error400()
     {
         $this->view("error/400", ["title" => "Error 400"]);
     }

     private function error403()
     {
         $this->view("error/403", ["title" => "Error 403"]);
     }
      
     private function error404()
     {
         $this->view("error/404", ["title" => "Error 404"]);
     }
 
     private function error500()
     {
        $this->view("error/500", ["title" => "Error 500"]);
     }

     private function error405(){
      $this->view("error/405", ["title" => "Error 405"]);
     }

}