<?php

namespace LearnPhpMvc\controller;

use CURLFile;
use Google\Service\Docs\Response;
use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

use function PHPUnit\Framework\isEmpty;

class GerakanControllerView
{
    protected $model = [
        'title' => "MMA GYM",
        'content' => "Login",
        'aktif'=>'inventory',
        'inventory'=>'gerakan'
    ];

    public function index()
    {
        View::render('/admin/gerakan', $this->model);
    }

    public function addData()
    {
        session_start();
        $curl = curl_init();
        $foto = $_FILES['foto-gerakan']['tmp_name'];
        $video = $_FILES['video-gerakan']['tmp_name'];
        $nama = $_POST['nama'];
        $id_alat = $_POST['id_alat'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl() . '/api/gerakan/add',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'foto-gerakan' => new CURLFile($foto),
                'video-gerakan' => new CURLFILE($video),
                'nama' => $nama,
                'id_alat' => $id_alat
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
                        'text' => "gerakan dengan nama $nama berhasil ditamabah"
                    ];
                    View::redirect('gerakan');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'tamaba data gagal',
                        'text' => "user dengan nama $nama gagal ditambah"
                    ];
                    View::redirect('gerakan');
                }
        } else {
            echo "<script>
            function myFunction() {
            alert('$response');
            }
            </script>
            ";
        }
    }

    public function delete()
    {
        session_start();
        $idgerakan = $_GET['id'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Url::BaseUrl().'api/gerakan/delete',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{ "id":' . $idgerakan . '}',
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
                        'text' => "gerakan dengan id $idgerakan berhasil dihapus"
                    ];
                    View::redirect('gerakan');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'hapus data gagal',
                        'text' => "gerakan dengan id $idgerakan gagal dihapus"
                    ];
                    View::redirect('gerakan');
                }
        } else {
            echo "<script>
            function myFunction() {
            alert('$response');
            }
            </script>
            ";
        }
    }

    public function edit()
    {
        session_start();
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $gamabar = $_FILES['foto-gerakan']['tmp_name'];
        $video = $_FILES['video-gerakan']['tmp_name'];
        $id_alat = $_POST['id_alat'];



        if (empty($video) && empty($gamabar)) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => Url::BaseUrl() . '/api/gerakan/edit/noFile',
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
                                            "id_alat":"' . $id_alat . '"
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
                        'text' => "gerakan dengan id $id berhasil diedit"
                    ];
                    View::redirect('gerakan');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'edit data gagal',
                        'text' => "gerakan dengan id $id gagal diedit"
                    ];
                    View::redirect('gerakan');
                }
            } else {
                echo $response;
            }
        } else if (empty($video)) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => Url::BaseUrl() . 'api/gerakan/edit/Withfot',
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
                    'id_alat' => $id_alat,
                    'foto-gerakan' => new CURLFILE($gamabar)
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
                        'text' => "gerakan dengan id $id berhasil diedit"
                    ];
                    View::redirect('gerakan');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'edit data gagal',
                        'text' => "gerakan dengan id $id gagal diedit"
                    ];
                    View::redirect('gerakan');
                }
            } else {
                echo $response;
            }
        } else if (empty($gamabar)) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/mmagym/src/public/api/gerakan/edit/Withvid',
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
                    'id_alat' => $id_alat, 
                    'video-gerakan' => new CURLFILE($video)),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            curl_close($curl);
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                $status = json_decode($response)->status;
                if ($status == 'succes') {
                    $_SESSION['notification'] = [
                        'status' => true,
                        'title' => 'edit data berhasil',
                        'text' => "gerakan dengan id $id berhasil diedit"
                    ];
                    View::redirect('gerakan');
                } else {
                    $_SESSION['notification'] = [
                        'status' => false,
                        'title' => 'edit data gagal',
                        'text' => "gerakan dengan id $id gagal diedit"
                    ];
                    View::redirect('gerakan');
                }
            } else {
                echo $response;
            }
        } else {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => Url::BaseUrl() . '/api/gerakan/edit',
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
                    'id_alat' => $id_alat,
                    'foto-gerakan' => new CURLFILE($gamabar),
                    'video-gerakan' => new CURLFILE($video)
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
                echo $response;
                header("location:" . url::BaseUrl() . 'gerakan');
            } else {
                echo $response;
            }
        }
    }
}
