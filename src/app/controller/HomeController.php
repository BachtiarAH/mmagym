<?php
namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class HomeController  
{
    public function index(){
        $model=[
            'title'=>"MMA GYM",
            'content'=>"Login"
        ];

        View::render("/admin/dashboard" , $model);
        // View::redirect("");
    }

    function turnPage($page,$model = array('title'=>"AMM GYM")){

        View::render("/admin/dashboard" , $model);
        // View::redirect("");
    }

    public function landing()
    {
        $model=[
            'title'=>"MMA GYM",
            'content'=>"Login"
        ];

        View::renderWithoutNavbar("/landing-page" , $model);
        // View::redirect("");
    }
}

?>