<?php

namespace LearnPhpMvc\Service;

use LearnPhpMvc\repository\userRepository;
use LearnPhpMvc\Service\Service;

use function PHPUnit\Framework\isEmpty;

class AuthService extends Service
{
    protected userRepository $userRepo;

    public function __construct($userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login($request)
    {
        if (isset($request->email) && isset($request->password)) {
            $email = $request->email;
            $password = $request->password;
            $jsonResult = $this->userRepo->findByEmail($email);
            if ($jsonResult['respons_code'] == 200) {
                $emailResult = $jsonResult['body'][0]['email'];
                $passwordResult = $jsonResult['body'][0]['password'];
                // echo $emailResult;
                if ($email == $emailResult && $password == $passwordResult) {
                    return [
                        'status' => 'login success',
                        'body' => $jsonResult['body']
                    ];
                } else if (isEmpty($jsonResult)) {
                    return [
                        'status' => 'login fail',
                        'message' => 'email unregistered'
                    ];
                } else {
                    return [
                        'status' => 'login fail',
                        'message' => 'password is wrong'
                    ];
                }
            }
        } else {
            return [
                'status' => 'login fail',
                'message' => 'email unregistered'
            ];
        }
    }
}
