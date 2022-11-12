<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class GerakanControllerView  
{
    protected $model=[
        'title'=>"MMA GYM",
        'content'=>"Login"
    ];

    public function index()
    {
        View::render('/admin/gerakan',$this->model);
    }
}
