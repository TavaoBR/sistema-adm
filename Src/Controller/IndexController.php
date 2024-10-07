<?php

namespace Src\Controller;
use Config\TemplateConfig;

class IndexController extends TemplateConfig{
    public function index(){
        $this->view("index", ["title" => "Index"]);
    }

    public function test(){
       
    }
}