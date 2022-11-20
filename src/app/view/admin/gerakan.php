<?php
$result = $api->get("/api/gerakan/all", ['q' => "#php"]);
// var_dump($result->response);
$dataJson = $result->response;


function JsonToTabel($json)
{
    $html = '';
    $object = json_decode($json);
    if (isset($object->body)) {
        $data = $object->body;
        // var_dump($data);
        echo count($data);

        for ($i = 0; $i < count($data); $i++) {
            $id = $data[$i]->id;
            $nama = $data[$i]->gerakan;
            $video = $data[$i]->video;
            $gambar = $data[$i]->gambar;
            $alat = $data[$i]->alat;

            // var_dump($id);
            $html .= "
                <tr >
                    <td class='id' onclick='tbClicked()'> $id </td>
                    <td class='data-nama' onchange='tes()' contenteditable='true' onclick='tbClicked()'> $nama</td>
                    <td class='data-gambar' onchange='tes()' onclick='tbClicked()'> $video</td>
                    <td class='data-gambar' onchange='tes()' onclick='tbClicked()'> $gambar</td>
                    <td class='data-gambar' onchange='tes()' onclick='tbClicked()'> $alat</td>
                    <td><i class='fa-solid fa-trash' onclick='deleteAlat()'></i></td>
                </tr>
                ";
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


    </div>
</section>
<!-- /.content-header -->