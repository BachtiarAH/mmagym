<?php

use LearnPhpMvc\Config\Url;


function getMenuLatihan()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => Url::BaseUrl().'api/menu/all',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function JsonToTabel($json)
{
    $html = '';
    $object = json_decode($json);
    if (isset($object->body)) {
        $data = $object->body;
        if (isset($data[0]->id) && isset($data[0]->nama)) {
            for ($i = 0; $i < count($data); $i++) {
                $id = $data[$i]->id;
                $nama = $data[$i]->nama;
                $part = $data[$i]->part;
                $level = $data[$i]->level;
                $gambar = $data[$i]->gambar;

                $html .= "
                        <tr>
                            <td>$id</td>
                            <td>$nama</td>
                            <td>$part</td>
                            <td>$level</td>
                            <td>$gambar</td>
                            <td>
                                <div class='row'>
                                    <a href=''><i class='fa-solid fa-trash'></i></a>
                                    <i class='fa-solid fa-pen-to-square col'></i>
                                </div>
                            </td>
                        </tr>
                ";
            }
        }
    }

    return $html;
}


$dataHtml = JsonToTabel(getMenuLatihan());
// var_dump($dataHtml);

?>



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Menu Latihan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Repository</a></li>
                    <li class="breadcrumb-item active">Menu Latihan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- table -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Menu Latihan</h3>
            </div>
            <div class="card-body">
                <table id="table-menu" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>nama menu</th>
                            <th>part</th>
                            <th>level</th>
                            <th>gambar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$dataHtml?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>