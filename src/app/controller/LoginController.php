<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

class LoginController
{
    function index()
    {
        $model = [
            'title' => "MMA GYM",
            'content' => "Login"
        ];

        View::renderWithoutNavbar("/login/login", $model);
        // View::redirect("");
    }

    public function login()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl().'/api/auth/login/admin',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                    "email":"'.$_POST['email'].'",
                    "password":"'.$_POST['password'].'"
                }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        $data = json_decode($response);
        var_dump($data);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
            session_start();
            $_SESSION['id'] = $data->body[0]->id;
            $_SESSION['nama'] = $data->body[0]->nama;
            $_SESSION['email'] = $data->body[0]->email;
            $_SESSION['alamat'] = $data->body[0]->alamat;
            $_SESSION['akses'] = $data->body[0]->akses;
            $_SESSION['password'] = $data->body[0]->password;
            var_dump($_SESSION);
            View::redirect('/admin');
        } else {
            echo $response;
        }

        // echo "redirectiing";
        // View::redirect('/admin');
    }
}
