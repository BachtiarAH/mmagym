<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

class UsersControllerView
{
    protected $model = [
        'title' => "MMA GYM",
        'content' => "Login"
    ];
    public function index()
    {
        View::render('/admin/user', $this->model);
    }

    
}
