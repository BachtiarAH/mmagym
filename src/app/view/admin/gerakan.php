<?php

use LearnPhpMvc\Config\Url;

$result = $api->get("/api/gerakan/all", ['q' => "#php"]);
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

function getalat()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => Url::BaseUrl() . 'api/alat/findAll%20',
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

function jsonToOption($json)
{
    $html = '';
    $object = json_decode($json);
    if (isset($object->body)) {
        $data = $object->body;

        for ($i = 0; $i < count($data); $i++) {
            $id = $data[$i]->id;
            $nama = $data[$i]->nama;

            // var_dump($id);
            $html .= "
                <option value='$id'>$nama</option>
                ";
        }
    }

    return $html;
}


function JsonToTabel($json)
{
    $html = '';
    $object = json_decode($json);
    if (isset($object->body)) {
        $data = $object->body;

        for ($i = 0; $i < count($data); $i++) {
            $id = $data[$i]->id;
            $nama = $data[$i]->gerakan;
            $video = $data[$i]->video;
            $gambar = $data[$i]->gambar;
            $id_alat = $data[$i]->id_alat;
            $alat = $data[$i]->alat;

            // var_dump($id);
            $html .= "
                <tr '>
                    <td class='id' onclick='tbClicked()'> $id </td>
                    <td class='data-nama'' contenteditable='true' onclick='tbClicked()'> $nama</td>
                    <td class='' ><i class='fa-brands fa-youtube fa-xl' onclick='bukaVideoLink(this)' data-toggle='modal' data-target='#modal-video-gerakan' data-link-video='$video'></i></td>
                    <td class='data-gambar' > <img src='https://drive.google.com/uc?export=view&id=$gambar' alt='$gambar' srcset=''></td>
                    <td class='' onclick=''> $alat</td>
                    <td>
                        <div class='row'>
                            <a href='" . url::BaseUrl() . "gerakan/delete?id=$id'><i class='fa-solid fa-trash'></i></a>
                            <i class='fa-solid fa-pen-to-square col' class='btn btn-primary' data-toggle='modal' data-target='#modal-form-gerakan'  data-id='$id' data-idAlat='$id_alat' data-nama='$nama' onclick='setModalFormGerakan(this)'></i>
                        </div>
                    </td>
                </tr>
                ";
        }
    }

    return $html;
}


$dataHtml = JsonToTabel($dataJson);
$alatHtml = jsonToOption(getalat());

?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Gerakan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Repository</a></li>
                    <li class="breadcrumb-item active">Gerakan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Gerakan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table-gerakan" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>gerakan</th>
                                        <th>video</th>
                                        <th>gambar</th>
                                        <th>alat</th>
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
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-sm-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">edit / add</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?= Url::BaseUrl() ?>gerakan/add" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="form-name">Nama</label>
                            <input required type="text" value="" name="nama" class="form-control" id="form-name" placeholder="">
                        </div>
                        <label for="form-gambar">Gambar</label>
                        <div class="custom-file form-group">
                            <input required accept="image/*" onchange="setLabelInput(this)" type="file" class="custom-file-input" name="foto-gerakan" id="upload-file-alat" onchange="">
                            <label class="custom-file-label" for="customFile" id="form-gambar">masukan gambar disini</label>
                        </div>
                        <label for="form-gambar">Video</label>
                        <div class="custom-file form-group">
                            <input required accept="video/*" onchange="setLabelInput(this)" type="file" class="custom-file-input" name="video-gerakan" id="upload-file-alat" onchange="">
                            <label class="custom-file-label" for="customFile" id="form-gambar">masukan video disini</label>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Select</label>
                            <select required name="id_alat" class="form-control">
                                <option value=""></option>
                                <?= $alatHtml ?>
                            </select>
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
<!-- /.content-header -->

<div class="modal fade" id="modal-video-gerakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Alat</h5>
                <button type="button" onclick="bersihkanmodel()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="pemutar-video">
            </div>
            <div class="modal-footer">
                <button type="button" onclick="bersihkanmodel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form-gerakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Alat</h5>
                <button type="button" onclick="bersihkanmodel()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="">
                <form action="<?= Url::BaseUrl() ?>gerakan/edit" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="form-name">Id</label>
                            <input required type="text" value="" name="id" class="form-control" id="modal-form-id" placeholder="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="form-name">Nama</label>
                            <input required type="text" value="" name="nama" class="form-control" id="modal-form-name" placeholder="">
                        </div>
                        <label for="form-gambar">Gambar</label>
                        <div class="custom-file form-group">
                            <input accept="image/*" onchange="setLabelInput(this)" type="file" class="custom-file-input" name="foto-gerakan" id="upload-file-alat" onchange="">
                            <label class="custom-file-label" for="customFile" id="form-gambar">masukan gambar disini</label>
                        </div>
                        <label for="form-gambar">Video</label>
                        <div class="custom-file form-group">
                            <input accept="video/*" onchange="setLabelInput(this)" type="file" class="custom-file-input" name="video-gerakan" id="upload-file-alat" onchange="">
                            <label class="custom-file-label" for="customFile" id="form-gambar">masukan video disini</label>
                        </div>
                        <!-- select -->
                        <div class="form-group">
                            <label>Select</label>
                            <select id="modal-form-idAlat" required name="id_alat" class="form-control">
                                <option value=""></option>
                                <?= $alatHtml ?>
                            </select>
                        </div>
                    </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" onclick="bersihkanmodel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

