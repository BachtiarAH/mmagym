<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\userRepository;
use LearnPhpMvc\Service\userService;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class UserController
{
    public userService $service;

    /**
     * @param userService $service
     */
    public function __construct()
    {
        $repo = new userRepository(Database::getConnection());
        $this->service = new userService($repo);
    }

    function findAll(){
        $arr = $this->service->FindAll();
        echo json_encode($arr);
    }


}