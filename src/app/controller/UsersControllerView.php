<?php

namespace LearnPhpMvc\controller;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

class UsersControllerView
{
    protected $model = [
        'title' => "MMA GYM",
        'content' => "Login",
        'aktif'=>'acount'
    ];
    public function index()
    {
        View::render('/admin/user', $this->model);
    }

    public function add()
    {
        session_start();
        $curl = curl_init();
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];
        $akses = $_POST['akses'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl() . 'api/user/add',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "nama": "' . $nama . '",
    "email" : "' . $email . '",
    "password" : "' . $password . '",
    "alamat" : "' . $alamat . '",
    "akses" : ' . $akses . '
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: PHPSESSID=e2ff47h1vu2dndmqdbj7fceqed'
            ),
        ));

        $response = curl_exec($curl);
        $status = json_decode($response)->status;
        curl_close($curl);
        if ($status == 'succes') {
            $_SESSION['notification'] = [
                'status' => true,
                'title' => 'tambah data berhasil',
                'text' => "user dengan email $email berhasil ditambahkan"
            ];
            View::redirect('user');
        } else {
            $_SESSION['notification'] = [
                'status' => false,
                'title' => 'tambah data gagal',
                'text' => "user dengan email $email gagal ditambahkan"
            ];
            View::redirect('user');
        }
    }

    public function delete()
    {
        session_start();
        $curl = curl_init();
        $id = $_GET['id'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl() . 'api/user/delet',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '
                    {
                        "id":' . $id . '
                    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: PHPSESSID=e2ff47h1vu2dndmqdbj7fceqed'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $status = json_decode($response)->status;
        if ($status == 'succes') {
            $_SESSION['notification'] = [
                'status' => true,
                'title' => 'hapus data berhasil',
                'text' => "user dengan id $id berhasil dihapus"
            ];
            View::redirect('user');
        } else {
            $_SESSION['notification'] = [
                'status' => false,
                'title' => 'hapus data gagal',
                'text' => "user dengan email $id gagal dihapus"
            ];
            View::redirect('user');
        }
    }

    public function edit()
    {
        session_start();
        $curl = curl_init();
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];
        $akses = $_POST['akses'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl().'api/user/edit',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '
                {
                    "id":'.$id.',
                    "nama":"'.$nama.'",
                    "password":"'.$password.'",
                    "email":"'.$email.'",
                    "alamat":"'.$alamat.'",
                    "akses":'.$akses.'
                }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $status = json_decode($response)->status;
        if ($status == 'succes') {
            $_SESSION['notification'] = [
                'status' => true,
                'title' => 'edit data berhasil',
                'text' => "user dengan id $id berhasil diedit"
            ];
            View::redirect('user');
        } else {
            $_SESSION['notification'] = [
                'status' => false,
                'title' => 'edit data gagal',
                'text' => "user dengan email $id gagal diedit"
            ];
            View::redirect('user');
        }
    }
}
