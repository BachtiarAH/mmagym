<?php

// use LearnPhpMvc\APP\View;

use LearnPhpMvc\APP\View;
use LearnPhpMvc\Config\Url;
use LearnPhpMvc\controller\HomeController;

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
                <div class="image">
                    <img src="AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?=View::getUrl('admin')?>" class="nav-link active">
                            <iconify-icon class="nav-icon fas " icon="carbon:dashboard-reference"></iconify-icon>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=View::getUrl('user')?>" class="nav-link">
                            <iconify-icon class="nav-icon fas " icon="charm:people"></iconify-icon>
                            <p>
                                Acounts
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                        <iconify-icon class="nav-icon fas" icon="ion:file-tray-stacked"></iconify-icon>
                            <p>
                                
                                Inventroy
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=View::getUrl('alat')?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Alat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=View::getUrl('gerakan')?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gerakan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=View::getUrl('menu')?>" class="nav-link">
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

