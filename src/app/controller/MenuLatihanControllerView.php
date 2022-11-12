<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class MenuLatihanControllerView{
    protected $model=[
        'title'=>"MMA GYM",
        'content'=>"Login"
    ];

    public function index()
    {
        View::render('/admin/menu-latihan',$this->model);
    }
}