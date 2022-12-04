<?php

use LearnPhpMvc\Config\Url;

if (isset($_SESSION['notification'])) {
    $title = $_SESSION['notification']['title'];
    $text = $_SESSION['notification']['text'];
    if ($_SESSION['notification']['status']) {
        echo "<script>
        Toast.fire({
            icon: 'success',
            title: '$title',
            text: '$text',
            })
    </script>";
        unset($_SESSION['notification']);
    } else {
        echo "<script>
        Toast.fire({
            icon: 'error',
            title: '$title',
            text: '$text',
            })
    </script>";
        unset($_SESSION['notification']);
    }
}

function getMenuLatihan()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => Url::BaseUrl() . 'api/menu/all',
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
                                    <a href='".Url::BaseUrl()."menu/delete?id=$id'><i class='fa-solid fa-trash'></i></a>
                                    <div data-toggle='modal' data-target='#model_form_menu_edit' 
                                    data-id='$id' data-nama='$nama' data-part='$part' data-level='$level' onclick='setModalMenuEdit(this)'><i class='fa-solid fa-pen-to-square col' ></i></div>
                                    <a href='".Url::BaseUrl()."menuAdd?id=$id'><i class='fa-solid fa-list'></i></a>
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
                            <th> <button type="button" class="btn btn-primary" data-toggle='modal' data-target='#model_form_menu_add'>add</button> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $dataHtml ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="model_form_menu_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= Url::BaseUrl() ?>menu/add" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="form-name">Nama</label>
                        <input required type="text" value="" name="nama" class="form-control" id="model-form-name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Part</label>
                        <input required type="text" value="" name="part" class="form-control" id="model-form-name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select required name="level" class="form-control">
                            <option value=""></option>
                            <option value="pemula">pemula</option>
                            <option value="menengah">menengah</option>
                            <option value="mahir">mahir</option>
                        </select>
                    </div>
                    <label for="form-gambar">Gambar</label>
                    <div class="custom-file form-group" id="model-container-gambar">
                        <input type="file" class="custom-file-input" name="foto-menu" id="model-file-alat" accept="image/*" required onchange="setLabelInput(this)">
                        <label class="custom-file-label" for="customFile" id="model-form-gambar">Gambar</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="model_form_menu_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= Url::BaseUrl() ?>menu/edit" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="id" id="model-form-id-edit">
                    <div class="form-group">
                        <label for="form-name">Nama</label>
                        <input required type="text" value="" name="nama" class="form-control" id="model-form-name-edit" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Part</label>
                        <input required type="text" value="" name="part" class="form-control" id="model-form-part-edit" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select required name="level" class="form-control" id="model-form-level-edit">
                            <option value=""></option>
                            <option value="pemula">pemula</option>
                            <option value="menengah">menengah</option>
                            <option value="mahir">mahir</option>
                        </select>
                    </div>
                    <label for="form-gambar">Gambar</label>
                    <div class="custom-file form-group" id="model-container-gambar">
                        <input type="file" class="custom-file-input" name="foto-menu" id="model-file-menu-edit" accept="image/*" onchange="setLabelInput(this)">
                        <label class="custom-file-label" for="customFile" id="model-form-gambar">Gambaras</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-header -->