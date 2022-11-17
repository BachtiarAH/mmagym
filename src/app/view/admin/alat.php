<?php
$result = $api->get("/api/alat/findAll", ['q' => "#php"]);
// var_dump($result->response);
$dataJson = $result->response;

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
                <tr >
                    <td class='id' onclick='tbClicked()'> $id </td>
                    <td class='data-nama' onchange='tes()' contenteditable='true' onclick='tbClicked()'> $nama</td>
                    <td class='data-gambar' onchange='tes()' onclick='tbClicked()'> $gambar</td>
                    <td><i class='fa-solid fa-trash' onclick='deleteAlat()'></i></td>
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
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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
                                    <?php echo $dataHtml;?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>nama</th>
                                        <th>gambar</th>
                                        <th></th>
                                    </tr>
                                </tfoot> -->
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
                    <h3 class="card-title">edit / add</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                    <div class="form-group" id="alatId" hidden>
                        <label for="form-id">id</label>
                        <input type="text" value="" class="form-control" id="form-id" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="form-name">Nama</label>
                        <input type="text" value="" class="form-control" id="form-name" placeholder="">
                    </div>
                    <label for="form-gambar">Gambar</label>
                    <div class="custom-file form-group">
                        <input type="file" class="custom-file-input" id="upload-file-alat" onchange="changeLabelGambarALat()">
                        <label class="custom-file-label" for="customFile" id="form-gambar">Gambar</label>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" onclick="submitAlat()">Submit</button>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- /.content-header -->