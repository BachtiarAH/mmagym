<?php
namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;

class AlatControllerView{
    protected $model=[
        'title'=>"MMA GYM",
        'content'=>"Login"
    ];

    public function index()
    {
        View::render('/admin/alat',$this->model);
    }

}