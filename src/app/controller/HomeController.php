<?php
namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class HomeController  
{
    protected $model=[
        'title'=>"MMA GYM",
        'content'=>"Login"
    ];

    public function index(){
        

        View::render("/admin/dashboard" , $this->model);
        // View::redirect("");
    }

    function turnPage($page,$model = array('title'=>"AMM GYM")){

        View::render("/admin/dashboard" , $this->model);
        // View::redirect("");
    }
}

?>