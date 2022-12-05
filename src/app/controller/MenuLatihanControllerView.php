<?php

namespace LearnPhpMvc\controller;

use CURLFile;
use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

class MenuLatihanControllerView
{
    protected $model = [
        'title' => "MMA GYM",
        'content' => "Login",
        'aktif'=>'inventory',
        'inventory'=>'menu'
    ];

    public function index()
    {
        View::render('/admin/menu-latihan', $this->model);
    }

    public function renderAdd()
    {
        View::render('/admin/menuLatihanAdd', $this->model);
    }

    public function add()
    {
        session_start();
        if (isset($_POST['nama']) && isset($_POST['part']) && isset($_POST['level']) && isset($_FILES['foto-menu'])) {
            $curl = curl_init();
            $nama = $_POST['nama'];
            curl_setopt_array($curl, array(
                CURLOPT_URL => Url::BaseUrl() . 'api/menu/add',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'nama' => $_POST['nama'],
                    'part' => $_POST['part'],
                    'level' => $_POST['level'],
                    'foto-menu' => new CURLFile($_FILES['foto-menu']['tmp_name'])
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            curl_close($curl);
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                $status = json_decode($response)->status;
                if ($status == 'succes') {
                    $_SESSION['notification'] = [
                        'status' => true,
                        'title' => 'tambah data berhasil',
                        'text' => "menu latihan dengan nama $nama berhasil ditamabah"
                    ];
                    View::redirect('menu');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'tambah data gagal',
                        'text' => "menu latihan dengan nama $nama gagal ditambah"
                    ];
                    View::redirect('menu');
                }
            } else {
                echo $response;
            }
        } else {
            echo "data ada yang salah";
        }
    }

    public function edit()
    {
        session_start();
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $part = $_POST['part'];
        $level = $_POST['level'];
        if ($_FILES['foto-menu']['tmp_name'] != '') {
            $curl = curl_init();

            $file = $_FILES['foto-menu']['tmp_name'];
            curl_setopt_array($curl, array(
                CURLOPT_URL => Url::BaseUrl() . 'api/menu/update',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'id' => $id,
                    'nama' => $nama,
                    'part' => $part,
                    'level' => $level,
                    'foto-menu' => new CURLFILE($file)
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
                        'text' => "menu dengan id $id berhasil diedit"
                    ];
                    View::redirect('menu');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'edit data gagal',
                        'text' => "menu dengan email $id gagal diedit"
                    ];
                    View::redirect('menu');
                }
            } else {
                echo $response;
            }
        } else {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => Url::BaseUrl() . 'api/menu/updateNoFot',
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
                        "part":"' . $part . '",
                        "level":"' . $level . '"
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
                        'text' => "menu dengan id $id berhasil diedit"
                    ];
                    View::redirect('menu');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'edit data gagal',
                        'text' => "menu dengan email $id gagal diedit"
                    ];
                    View::redirect('menu');
                }
            } else {
                echo $response;
            }
        }
    }

    public function deletData()
    {
        session_start();
        $curl = curl_init();
        $id = $_GET['id'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl().'api/menu/delete',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "id":"'.$id.'"
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
                    'text' => "menu dengan id $id berhasil dihapus"
                ];
                View::redirect('menu');
            } else {
                $_SESSION['notification'] = [
                    'status' => false,
                    'title' => 'hapus data gagal',
                    'text' => "menu dengan email $id gagal dihapus"
                ];
                View::redirect('menu');
            }
        } else {
            echo $response;
        }
    }

    public function rincianMenuAdd()
    {
        session_start();
        // var_dump($_POST);
        $curl = curl_init();

        $repetisi = $_POST['repetisi'];
        $set = $_POST['set'];
        $note = $_POST['note'];
        $id_gerakan = $_POST['id_gerakan'];
        $id_menu_latihan = $_POST['id'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl() . 'api/menu/add/rincian',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '
                        {
                            "repetisi": ' . $repetisi . ',
                            "set":' . $set . ',
                            "note":"' . $note . '",
                            "id_gerakan": ' . $id_gerakan . ',
                            "id_menu_latihan": ' . $id_menu_latihan . '
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
                    'title' => 'tambah data berhasil',
                    'text' => "gerakan berhasil ditambahkan"
                ];
                View::redirect('menuAdd?id=' . $id_menu_latihan);
            } else {
                $_SESSION['notification'] = [
                    'status' => false,
                    'title' => 'tambah data gagal',
                    'text' => "gerakan gagal ditamabahkan"
                ];
                View::redirect('menuAdd?id=' . $id_menu_latihan);
            }
        } else {
            echo $response;
        }
    }

    public function deleteRincian()
    {
        session_start();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl() . 'api/menu/delete/rincian',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"id":' . $_GET['id'] . '}',
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
                    'text' => "gerakan berhasil dihapus"
                ];
                View::redirect('menuAdd?id=' . $_GET['id_menu']);
            } else {
                $_SESSION['notification'] = [
                    'status' => false,
                    'title' => 'hapus data gagal',
                    'text' => "gerakan gagal dihapus"
                ];
                View::redirect('menuAdd?id=' . $_GET['id_menu']);
            }
        } else {
            echo $response;
        }
    }

    public function editRincian()
    {
        session_start();
        // var_dump($_POST);
        $curl = curl_init();
        $note = $_POST['note'];
        $repetisi = $_POST['repetisi'];
        $set = $_POST['set'];
        $id_gerakan = $_POST['id_gerakan'];
        $id = $_POST['id'];
        $id_menu_latihan = $_POST['id_menu'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl() . 'api/menu/update/rincian',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '
                        {
                            "id":' . $id . ' ,
                            "repetisi":' . $repetisi . ',
                            "set":' . $set . ',
                            "note":"' . $note . '",
                            "id_gerakan":' . $id_gerakan . '
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
                    'text' => "gerakan berhasil diedit"
                ];
                View::redirect('menuAdd?id=' . $id_menu_latihan);
            } else {
                $_SESSION['notification'] = [
                    'status' => false,
                    'title' => 'edit data gagal',
                    'text' => "gerakan gagal diedit"
                ];
                View::redirect('menuAdd?id=' . $id_menu_latihan);
            }
        } else {
            echo $response;
        }
    }
}
