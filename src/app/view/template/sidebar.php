<?php

// use LearnPhpMvc\APP\View;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\controller\HomeController;

function getDataProfil()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => Url::BaseUrl() . 'api/user/id',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
    "id": ' . $_SESSION['id'] . '
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=e2ff47h1vu2dndmqdbj7fceqed'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

$dataProfil = json_decode(getDataProfil());
$nama = $dataProfil->body[0]->nama;
$email = $dataProfil->body[0]->email;
$password = $dataProfil->body[0]->password;
$alamat = $dataProfil->body[0]->alamat;
$akses = $dataProfil->body[0]->akses;

$dashboard = '';
$acount = '';
$inventory = '';
$alat = '';
$gerakan = '';
$menu = '';

switch ($model['aktif']) {
    case 'dashboard':
        $dashboard = 'active';
        break;
    case 'acount':
        $acount = 'active';
        break;
    case 'inventory':
        $inventory = 'active';
        switch ($model['inventory']) {
            case 'alat':
                $alat = 'active';
                break;
            case 'gerakan':
                $gerakan = 'active';
                break;
            case 'menu':
                $menu = 'active';
                break;
            default:
                # code...
                break;
        }
        break;
    default:
        break;
}


?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="assets\logo-amm-gym.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AMM GYM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <?= $nama ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a id="dashboard" href="<?= View::getUrl('admin') ?>" class="nav-link <?= $dashboard ?>">
                        <iconify-icon class="nav-icon fas " icon="carbon:dashboard-reference"></iconify-icon>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="acount" href="<?= View::getUrl('user') ?>" class="nav-link <?= $acount ?>">
                        <iconify-icon class="nav-icon fas " icon="charm:people"></iconify-icon>
                        <p>
                            Acounts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="inventory" href="" class="nav-link <?= $inventory ?>">
                        <iconify-icon class="nav-icon fas" icon="ion:file-tray-stacked"></iconify-icon>
                        <p>
                            Inventroy
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= View::getUrl('alat') ?>" class="nav-link <?=$alat?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= View::getUrl('gerakan') ?>" class="nav-link <?=$gerakan?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gerakan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= View::getUrl('menu') ?>" class="nav-link <?=$menu?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu Latihan</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<!-- <aside class="control-sidebar control-sidebar-dark"> -->
<!-- Control sidebar content goes here -->
<!-- </aside> -->
<!-- /.control-sidebar -->