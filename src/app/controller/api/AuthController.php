<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\repository\OtpRepository;
use LearnPhpMvc\repository\userRepository;
use LearnPhpMvc\Service\AuthService;

class AuthController{
    protected AuthService $service ;

    public function __construct() {
        $userrRpo = new userRepository(Database::getConnection());
        $otpRepo = new OtpRepository(Database::getConnection());
        $this->service = new AuthService($userrRpo,$otpRepo);
    }

    public function login()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->login($request));
    }

    public function register()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->register($request));
    }

    public function verifyOtp()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->verifyOtp($request));
    }

    public function sendOtpAgain()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->sendNewOtp($request));
    }

    public function sendOtpResetPassword()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->sendOtpResetPassword($request));
    }

    public function resetPassword()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->resetPassword($request));
    }

    public function cekOtp()
    {
        $json = file_get_contents('php://input');
        $request = json_decode($json);
        echo json_encode($this->service->cekOtp($request));
    }
}