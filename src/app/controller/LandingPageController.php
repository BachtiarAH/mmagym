<?php
namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class LandingPageController  
{
    function index(){
        $model=[
            'title'=>"MMA GYM",
            'content'=>"Login"
        ];

        View::renderOnly("/landing-page" , $model);
        // View::redirect("");
    }

}