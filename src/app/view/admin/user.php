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



function getuser()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => url::BaseUrl() . '/api/user/all',
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
                $password = $data[$i]->password;
                $password_sensored = '';
                for ($j = 0; $j < strlen($password); $j++) {
                    $password_sensored .= '*';
                }
                $email = $data[$i]->email;
                $alamat = $data[$i]->alamat;
                $aksesIndex = $data[$i]->akses;
                $hakAkses = 'user';
                if ($aksesIndex == 1) {
                    $hakAkses = 'user';
                } else if ($aksesIndex == 2) {
                    $hakAkses = 'admin';
                } else {
                    $hakAkses = 'unknow';
                }


                $html .= "
                <tr>
                    <td>$id</td>
                    <td>$nama</td>
                    <td>$password_sensored</td>
                    <td>$email</td>
                    <td>$alamat</td>
                    <td data-akses='$aksesIndex'>$hakAkses</td>
                    <td>
                        <div class='row'>
                            <a href='" . url::BaseUrl() . "/user/delete?id=$id'>
                                <i class='fa-solid fa-trash col' data-id='$id'></i>
                            </a>
                            <i class='fa-solid fa-pen-to-square col' class='btn btn-primary' data-toggle='modal' data-target='#modal_form_user_edit' data-email='$email' data-id='$id' data-nama='$nama' data-alamat='$alamat' data-akses='$aksesIndex' data-password='$password' onclick='setModalUserEdit(this)'></i>
                        </div>
                    </td>
                </tr>
                ";
            }
        }
    }

    return $html;
}

$responseJson = getuser();
$dataHtml = JsonToTabel($responseJson);

?>

<div class="navbar navbar-light bg-light justify-content-between">
    <h1 class="m-0">User</h1>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">list data user</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="table-users" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>nama</th>
                                    <th>password</th>
                                    <th>email</th>
                                    <th>alamat</th>
                                    <th>akses</th>
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

    </div>
    <div class="col-sm-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">add</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?= Url::BaseUrl() ?>user/add" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="nama" required placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" required placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" required placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Akses</label>
                        <select class="form-control" name="akses" required>
                            <option value="2">admin</option>
                            <option value="1" selected>user</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>


    </div>
    <!-- /.content-header -->
    <!-- Modal -->
    <div class="modal fade" id="modal_form_user_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Alat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= Url::BaseUrl() ?>user/edit" method="post">
                    <div class="modal-body">
                        <input type="text" value="" name="id" id="modal-form-id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="modal-form-nama" name="nama" required placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="modal-form-email" name="email" required placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="modal-form-password" name="password" required placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" id="modal-form-alamat" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Akses</label>
                            <select class="form-control" name="akses" id="modal-form-akses" required>
                                <option value="2">admin</option>
                                <option value="1" selected>user</option>
                            </select>
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