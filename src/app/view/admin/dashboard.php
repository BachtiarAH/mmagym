<?php

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;

if ($_SESSION['logedin']) {
  $name = $_SESSION['nama'];
  echo "<script>
      Toast.fire({
            icon: 'success',
            title: 'login success',
            text: 'hello $name',
          })
    </script>";
  $_SESSION['logedin'] = false;
}

if (isset($_SESSION['notification'])) {
  if ($_SESSION['notification'] == 'success') {
    echo "<script>
      Toast.fire({
            icon: 'success',
            title: 'edit success',
            text: 'data profil berhasil diperbarui',
          })
    </script>";
    unset($_SESSION['notification']);
  } else {
    echo "<script>
      Toast.fire({
            icon: 'error',
            title: 'edit failed',
            text: 'terdapat masalah',
          })
    </script>";
    unset($_SESSION['notification']);
  }
}


function getAllUser()
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => Url::BaseUrl() . 'api/user/all',
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

function getAllGerakan()
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

function getAllAlat()
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

function getAllMenu()
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
// $dataProfil = json_decode(getDataProfil());
// $nama = $dataProfil->body[0]->nama;
// $email = $dataProfil->body[0]->email;
// $password = $dataProfil->body[0]->password;
// $alamat =$dataProfil->body[0]->alamat;
// $akses = $dataProfil->body[0]->akses;



$dataUsers = json_decode(getAllUser());
$dataGerakan = json_decode(getAllGerakan());
$dataAlat = json_decode(getAllAlat());
$dataMenu = json_decode(getAllMenu());

$jumlahUser = count($dataUsers->body);
$jumlahGerakan = count($dataGerakan->body);
$jumlahAlat = count($dataAlat->body);
$jumlahMenu = count($dataMenu->body);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Hoasdme</a></li>
          <li class="breadcrumb-item active">Dashboard v2</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-person-walking"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Gerakan</span>
            <span class="info-box-number"><?= $jumlahGerakan ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-dumbbell"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Alat</span>
            <span class="info-box-number"><?= $jumlahAlat ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fa-regular fa-clipboard"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Menu</span>
            <span class="info-box-number"><?= $jumlahMenu ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i> </span>

          <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number"><?= $jumlahUser ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-6">
        <div class="card">
          <div class="card-header">Your Profile</div>
          <div class="card-body">
            <form action="<?= Url::BaseUrl() ?>admin/editProfil" method="post">
              <input type="text" hidden name="id" value="<?= $_SESSION['id'] ?>">
              <div class="form-group">
                <label for="form-name">Nama</label>
                <input type="text" value="<?= $nama ?>" name="nama" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                <label for="form-name">Email</label>
                <input readonly type="email" value="<?= $email ?>" name="email" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                <label for="form-name">Password</label>
                <input type="password" value="<?= $password ?>" name="password" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" placeholder=""><?= $alamat ?></textarea>
              </div>
              <div class="form-group">
                <label for="form-name">Hak Akses</label>
                <input type="text" hidden name="akses" value="<?= $akses ?>">
                <input readonly type="text" value="<?php
                                                    if ($akses == 2) {
                                                      echo 'admin';
                                                    } else {
                                                      echo 'non set';
                                                    }
                                                    ?>" class="form-control" placeholder="">
              </div>

          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
      <div class="col-6">
        <div>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.374712041736!2d113.72252421469753!3d-8.164950594123093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695fc84b876ad%3A0xaa7aff97523a56f!2sAMM%20Gym!5e0!3m2!1sid!2sid!4v1670084939234!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>


      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <script>
        function nFormatter(num) {

          if (num >= 1000000) {
            return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
          }
          if (num >= 1000) {
            return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
          }
          return num;
        }


        $.ajax({
          url: "https://www.instagram.com/b.a_habibie?__a=1",
          type: 'get',
          success: function(response) {
            $(".profile-pic").attr('src', response.graphql.user.profile_pic_url);
            $(".name").html(response.graphql.user.full_name);
            $(".biography").html(response.graphql.user.biography);
            $(".username").html(response.graphql.user.username);
            $(".number-of-posts").html(response.graphql.user.edge_owner_to_timeline_media.count);
            $(".followers").html(nFormatter(response.graphql.user.edge_followed_by.count));
            $(".following").html(nFormatter(response.graphql.user.edge_follow.count));
            posts = response.graphql.user.edge_owner_to_timeline_media.edges;
            $(".posts").html(posts_html);
          }
        });
      </script>