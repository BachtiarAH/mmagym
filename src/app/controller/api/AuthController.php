<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\userRepository;
use LearnPhpMvc\Service\AuthService;

class AuthController{
    protected AuthService $service ;

    public function __construct() {
        $userrRpo = new userRepository(Database::getConnection());
        $this->service = new AuthService($userrRpo);
    }

    public function login()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->login($request));
    }
}