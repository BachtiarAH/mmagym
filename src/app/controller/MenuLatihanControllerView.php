<?php

namespace LearnPhpMvc\controller;

use CURLFile;
use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

class MenuLatihanControllerView
{
    protected $model = [
        'title' => "MMA GYM",
        'content' => "Login"
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
        if (isset($_POST['nama']) && isset($_POST['part']) && isset($_POST['level']) && isset($_FILES['foto-menu'])) {
            $curl = curl_init();

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
                echo $response;
                header("location:" . url::BaseUrl() . 'menu');
            } else {
                echo $response;
            }
        } else {
            echo "data ada yang salah";
        }
    }

    public function rincianMenuAdd()
    {
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
            echo $response;
            header("location:" . url::BaseUrl() . 'menuAdd?id=' . $id_menu_latihan);
        } else {
            echo $response;
        }
    }

    public function deleteRincian()
    {
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
            echo $response;
            header("location:" . url::BaseUrl() . 'menuAdd?id=' . $_GET['id_menu']);
        } else {
            echo $response;
        }
    }

    public function editRincian()
    {

        // var_dump($_POST);
        $curl = curl_init();
        $note = $_POST['note'];
        $repetisi = $_POST['repetisi'];
        $set = $_POST['set'];
        $id_gerakan = $_POST['id_gerakan'];
        $id = $_POST['id'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl().'api/menu/update/rincian',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '
                        {
                            "id":'.$id.' ,
                            "repetisi":'.$repetisi.',
                            "set":'.$set.',
                            "note":"'.$note.'",
                            "id_gerakan":'.$id_gerakan.'
                        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
            echo $response;
            header("location:" . url::BaseUrl() . 'menuAdd?id=' . $_POST['id_menu']);
        } else {
            echo $response;
        }
    }
}
