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
                    <td class='data-nama'' contenteditable='true' onclick='tbClicked()'> $nama</td>
                    <td class='' ><i class='fa-brands fa-youtube fa-xl'></i></td>
                    <td class='data-gambar' > <img src='https://drive.google.com/uc?export=view&id=$gambar' alt='$gambar' srcset=''></td>
                    <td class='' > $alat</td>
                    <td> <i class='fa-solid fa-trash' onclick='deleteAlat()'></i></td>
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

<div class="modal fade" id="modal_video_gerakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
            <iframe width="100%" height="100%" src=""></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>