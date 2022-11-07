<?php
namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class HomeController  
{
    function index(){
        $model=[
            'title'=>"MMA GYM",
            'content'=>"Login"
        ];

        View::render("/home/dashboard" , $model);
        // View::redirect("");
    }
}

?>