<?php

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

$result = $api->get("/api/alat/findAll", ['q' => "#php"]);
// var_dump($result->response);
$dataJson = $result->response;

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
                $gambar = $data[$i]->gambar;

                $html .= "
                <tr>
                ]                    <td class='id' onclick='tbClicked()'> $id </td>
                    <td class='data-nama'  > $nama</td>
                    <td class='data-gambar' '> <img src='https://drive.google.com/uc?export=view&id=$gambar' alt='$gambar' srcset=''></td>
                    <td>
                        <div class='row'>
                            <i data-hapus='" . url::BaseUrl() . "/alat/delete?id=$id' onclick='setLinkALatDelete(this)' data-toggle='modal' data-target='#model_delete' class='fa-solid fa-trash col' data-id='$id'></i>
                            <i class='fa-solid fa-pen-to-square col' class='btn btn-primary' data-toggle='modal' data-target='#model_form_alat'  data-gambar='$gambar' data-id='$id' data-nama='$nama' onclick='setModelForm(this)'></i>
                            <i class='fa-solid fa-qrcode' data-toggle='modal' data-target='#modal-qr' data-nama='$nama' data-id='$id' onclick='setData(this)'></i>
                        </div>
                    </td>
                </tr>
                ";
            }
        }
    }

    return $html;
}

$dataHtml = JsonToTabel($dataJson);
// var_dump($dataHtml);

?>





<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Alat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Repository</a></li>
                    <li class="breadcrumb-item active">Alat</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<section class="content">
    <div class="row ">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">list data alat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--
                             


                            
                            -->
                            <table id="table-alat" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>nama</th>
                                        <th>gambar</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $dataHtml; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">add</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?= Url::BaseUrl() . '/alat/add' ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="form-name">Nama</label>
                            <input required type="text" value="" name="nama" class="form-control" id="form-name" placeholder="">
                        </div>
                        <label for="form-gambar">Gambar</label>
                        <div class="custom-file form-group">
                            <input required type="file" class="custom-file-input" name="foto-alat" id="upload-file-alat" onchange="changeLabelGambarALat()">
                            <label class="custom-file-label" for="customFile" id="form-gambar">Gambar</label>
                        </div>
                    </div>

                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" onclick="">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="model_form_alat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= Url::BaseUrl() ?>alat/update" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group" id="alatId">
                        <label for="form-id">id</label>
                        <input type="text" value="" name="id" class="form-control" id="model-form-id" placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label for="form-name">Nama</label>
                        <input type="text" value="" name="nama" class="form-control" id="model-form-name" placeholder="">
                    </div>
                    <label for="form-gambar">Gambar</label>
                    <div class="custom-file form-group" id="model-container-gambar">
                        <input type="file" class="custom-file-input" name="foto-alat" id="model-file-alat" onchange="getFile(this)">
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
<!-- /.content-header -->
<!-- Modal -->
<div class="modal fade" id="model_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah and yakin ingin menghapus item ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">batal</button>
                <a href="" id="link-delete">
                    <button type="button" class="btn btn-danger">iya</button>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal QR-->
<div class="modal fade" id="modal-qr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="qr" class="qr-code-container">
                    <div  class="qr-code"></div>
                    <div class='qr-name row'>nama</div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="qr-download" download="" >
                    <button type="button" class="btn btn-block btn-primary">Download</button>
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cleaneQr(this)">oke</button>
            </div>
        </div>
    </div>
</div>