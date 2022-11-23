<?php

use LearnPhpMvc\Config\Url;

function getuser()
{
    $curl = curl_init();

curl_setopt_array($curl, array(
		CURLOPT_URL => url::BaseUrl().'/api/user/all',
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
                $email = $data[$i]->email;
                $alamat = $data[$i]->alamat;
                $aksesIndex = $data[$i]->akses;
                $hakAkses = 'user';
                if ($aksesIndex == 1) {
                    $hakAkses = 'user';
                } else if($aksesIndex == 2){
                    $hakAkses = 'admin';
                }else{
                    $hakAkses = 'unknow';
                }
                
                
                $html .= "
                <tr>
                    <td>$id</td>
                    <td>$nama</td>
                    <td>$email</td>
                    <td>$alamat</td>
                    <td data-akses='$aksesIndex'>$hakAkses</td>
                    <td>
                        <div class='row'>
                            <a href='" . url::BaseUrl() . "/alat/delete?id=$id'>
                                <i class='fa-solid fa-trash col' data-id='$id'></i>
                            </a>
                            <i class='fa-solid fa-pen-to-square col' class='btn btn-primary' data-toggle='modal' data-target='#model_form_alat' data-email='$email' data-id='$id' data-nama='$nama' data-alamat='$alamat' data-akses='$aksesIndex' onclick='setModelForm(this)'></i>
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

                        <table id="table-user" class="table table-bordered table-striped">
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
                                <?=$dataHtml?>
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
                <h3 class="card-title">edit / add</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
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