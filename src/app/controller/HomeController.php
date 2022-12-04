<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

class HomeController
{
    protected $model = [
        'title' => "MMA GYM",
        'content' => "Login"
    ];

    public function index()
    {


        View::render("/admin/dashboard", $this->model);
        // View::redirect("");
    }

    function turnPage($page, $model = array('title' => "AMM GYM"))
    {

        View::render("/admin/dashboard", $this->model);
        // View::redirect("");
    }

    public function editDataProfil()
    {
        session_start();
        $curl = curl_init();
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $akses = $_POST['akses'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl() . '/api/user/edit',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "id":' . $id . ',
    "nama":"' . $nama . '",
    "password":"' . $password . '",
    "email":"' . $email . '",
    "alamat":"' . $alamat . '",
    "akses":' . $akses . '
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response);
        // var_dump($data);
        if ($data->status == 'succes') {
            
            $_SESSION['notification'] = 'success';
            header('location:' . Url::BaseUrl() . 'admin');
        } else {
            $_SESSION['notification'] = 'fail';
            header('location:' . Url::BaseUrl() . 'admin');
        }

        var_dump($_SESSION);
    }
}
