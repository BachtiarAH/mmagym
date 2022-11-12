<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class LoginController  
{
    function index(){
        $model=[
            'title'=>"MMA GYM",
            'content'=>"Login"
        ];

        View::renderWithoutNavbar("/login/login" , $model);
        // View::redirect("");
    }

    public function login()
    {
        echo "redirectiing";
        View::redirect('/admin');
        // header('http://localhost/mmagym/src/public/admin');
        // $hompage = new HomeController();
        // $hompage->index();
    }
}
