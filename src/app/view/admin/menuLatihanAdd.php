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

function getData($id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => Url::BaseUrl() . 'api/menu/rincian',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '
                {
                        "id_menu":' . $id . '
                }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

function JsonToTabel($json)
{
    $id_menu = $_GET['id'];
    $html = '';
    $object = json_decode($json);

    if (isset($object->body)) {
        $data = $object->body->isi;
        if (isset($data[0]->id)) {
            for ($i = 0; $i < count($data); $i++) {
                $id = $data[$i]->id;
                $idGerakan = $data[$i]->id_gerakan;
                $nama = $data[$i]->nama_gerakan;
                $repetisi = $data[$i]->repetisi;
                $set = $data[$i]->set_latihan;
                $note = $data[$i]->note;

                $html .= "
                <tr>
                    <td class='id' onclick='tbClicked()'> $id </td>
                    <td class='data-nama'  > $nama</td>
                    <td class='data-nama'  > $note</td>
                    <td class='data-nama'  > $repetisi</td>
                    <td class='data-nama'  > $set</td>
                    <td>
                        <div class='row'>
                            <a href='" . Url::BaseUrl() . "menuAdd/delete?id=$id&id_menu=$id_menu'>
                                <i class='fa-solid fa-trash col' data-id='$id'></i>
                            </a>
                            <i data-toggle='modal' data-target='#modal-edit-detail-menu' class='fa-solid fa-pen-to-square col' class='btn btn-primary' data-toggle='modal' data-target='#model_form_alat' data-id='$id' data-nama='$nama' data-id-gerakan='$idGerakan' data-note='$note' data-repetisi='$repetisi' data-set='$set' onclick='setModalData(this)'></i>
                        </div>
                    </td>
                </tr>
                ";
            }
        }
    }
    // var_dump($html);

    return $html;
}

function getGerakan()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => Url::BaseUrl() . 'api/gerakan/all',
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
            $nama = $data[$i]->gerakan;

            // var_dump($id);
            $html .= "
                <option value='$id'>$nama</option>
                ";
        }
    }

    return $html;
}

function getDataMenu()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => Url::BaseUrl() . 'api/menu/id?id=' . $_GET['id'],
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

$dataMenu = json_decode(getDataMenu());
$OptionHtml = JsonToOption(getGerakan());
$dataHtml = JsonToTabel(getData($_GET['id']));
$ArrResponse = json_decode(getData($_GET['id']), true);
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><a href="<?= Url::BaseUrl() ?>menu">Menu Latihan</a>/add</h1>
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
<div class="content">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3>Menu Latihan</h3>
                        </div>
                        <div class="col-2"><button type="button" data-toggle="modal" data-target="#modal-add-detail-menu" class="btn btn-block btn-primary">Add</button></div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table-rincian-menu" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>gerakan</th>
                                <th>note</th>
                                <th>repetisi</th>
                                <th>set</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $dataHtml; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">Menu Latihan</div>
                <div class="card-body">
                    <label for="form-gambar">Gambar</label>
                    <div class="data-gambar" id="model-container-gambar">
                        <img src='https://drive.google.com/uc?export=view&id=<?= $dataMenu->body[0]->gambar ?>' alt='$gambar' srcset=''></td>
                    </div>
                    <div class="form-group">
                        <label for="form-name">Nama</label>
                        <input readonly type="text" value="<?= $dataMenu->body[0]->nama ?>" name="nama" class="form-control" id="model-form-name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Part</label>
                        <input readonly type="text" value="<?= $dataMenu->body[0]->part ?>" name="part" class="form-control" id="model-form-name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <input readonly type="text" value="<?= $dataMenu->body[0]->level ?>" name="part" class="form-control" id="model-form-name" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-detail-menu" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= Url::BaseUrl() ?>menu/add/rincian" method="post">
                <div class="modal-body">
                    <input type="text" value="<?= $_GET['id'] ?>" hidden name="id">
                    <div class="form-group">
                        <label>Gerakan</label>
                        <select class="form-control" name='id_gerakan'>
                            <?= $OptionHtml ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Note</label>
                        <input type="text" name="note" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">repetisi</label>
                        <input type="number" name="repetisi" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">set</label>
                        <input type="number" name="set" class="form-control" id="exampleInputEmail1" placeholder="">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-edit-detail-menu" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= Url::BaseUrl() ?>menuAdd/edit" method="post">
                <div class="modal-body">
                    <input type="text" value="<?= $_GET['id'] ?>" hidden name="id_menu">
                    <input id="form-model-id_rincian" type="text" hidden value="" name="id">
                    <div class="form-group">
                        <label>Gerakan</label>
                        <select class="form-control" id="form-data-gerakan" name='id_gerakan'>
                            <?= $OptionHtml ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Note</label>
                        <input type="text" name="note" class="form-control" id="form-modal-note" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">repetisi</label>
                        <input type="number" name="repetisi" class="form-control" id="form-modal-repetisi" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">set</label>
                        <input type="number" name="set" class="form-control" id="form-modal-set" placeholder="">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>