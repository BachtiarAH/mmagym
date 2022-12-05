<?php

namespace LearnPhpMvc\controller;

use CURLFile;
use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

use function PHPUnit\Framework\isEmpty;

class AlatControllerView
{
    protected $model = [
        'title' => "MMA GYM",
        'content' => "Login",
        'aktif'=>'inventory',
        'inventory'=>'alat'
    ];

    public function index()
    {
        View::render('/admin/alat', $this->model);
    }

    public function update()
    {
        session_start();
        if ($_FILES['foto-alat']['tmp_name'] != "") {
            $curl = curl_init();
            $apiEndPoin = 'api/alat/edit';
            $fileDir = $_FILES['foto-alat']['tmp_name'];
            $nama = $_POST['nama'];
            $id = $_POST['id'];

            curl_setopt_array($curl, array(
                CURLOPT_URL => Url::BaseUrl() . $apiEndPoin,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('foto-alat' => new CURLFile($fileDir), 'nama' => $nama, 'id' => $id),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                $status = json_decode($response)->status;
                if ($status == 'succes') {
                    $_SESSION['notification'] = [
                        'status' => true,
                        'title' => 'edit data berhasil',
                        'text' => "alat dengan id $id berhasil diedit"
                    ];
                    View::redirect('alat');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'edit data gagal',
                        'text' => "alat dengan email $id gagal diedit"
                    ];
                    View::redirect('alat');
                }
            } else {
                echo $response;
            }
        } else {
            $curl = curl_init();
            $id = $_POST['id'];
            $nama = $_POST['nama'];

            curl_setopt_array($curl, array(
                CURLOPT_URL => Url::BaseUrl() . 'api/alat/edit/nama',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                        "id": "' . $id . '",
                        "nama": "' . $nama . '"
                    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                $status = json_decode($response)->status;
                if ($status == 'succes') {
                    $_SESSION['notification'] = [
                        'status' => true,
                        'title' => 'edit data berhasil',
                        'text' => "alat dengan id $id berhasil diedit"
                    ];
                    View::redirect('alat');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'edit data gagal',
                        'text' => "alat dengan email $id gagal diedit"
                    ];
                    View::redirect('alat');
                }
            } else {
                echo $response;
            }
        }
    }



    public function add()
    {
        session_start();
        $curl = curl_init();
        $nama = $_POST['nama'];
        $pathfoto = $_FILES['foto-alat']['tmp_name'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl() . '/api/alat/add',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('foto-alat' => new CURLFILE($pathfoto), 'nama' => $nama),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
            $status = json_decode($response)->status;
                if ($status == 'succes') {
                    $_SESSION['notification'] = [
                        'status' => true,
                        'title' => 'tambah data berhasil',
                        'text' => "alat dengan nama $nama berhasil ditambah"
                    ];
                    View::redirect('alat');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'tambah data gagal',
                        'text' => "alat dengan nama $nama gagal ditambah"
                    ];
                    View::redirect('alat');
                }
        } else {
            echo $response;
        }
    }

    public function delete()
    {
        session_start();
        $curl = curl_init();
        $id = $_GET['id'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => url::BaseUrl() . '/api/alat/delet',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                    "id":"' . $id . '"
                    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
            $status = json_decode($response)->status;
                if ($status == 'succes') {
                    $_SESSION['notification'] = [
                        'status' => true,
                        'title' => 'hapus data berhasil',
                        'text' => "alat dengan id $id berhasil dihapus"
                    ];
                    View::redirect('alat');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'hapus data gagal',
                        'text' => "alat dengan id $id gagal dihapus"
                    ];
                    View::redirect('alat');
                }
        } else {
            echo $response;
        }
    }
}
