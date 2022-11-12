<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use LearnPhpMvc\APP\Router;
use LearnPhpMvc\controller\AlatControllerView;
use LearnPhpMvc\controller\api\AlatController;
use LearnPhpMvc\controller\api\CompanyControllerApi;
use LearnPhpMvc\controller\api\GerakanController;
use LearnPhpMvc\controller\api\JadwalController;
use LearnPhpMvc\controller\api\MenuLatihanController;
use LearnPhpMvc\controller\api\PencariMagang;
use LearnPhpMvc\controller\api\RiwayatController;
// use LearnPhpMvc\controller\api\userContrller;
use LearnPhpMvc\controller\api\userController;
use LearnPhpMvc\controller\CompanyController;
use LearnPhpMvc\controller\GerakanControllerView;
use LearnPhpMvc\controller\HomeController;
use LearnPhpMvc\controller\ProductController;
use LearnPhpMvc\controller\LamarController;
use LearnPhpMvc\controller\LandingPageController;
use LearnPhpMvc\controller\LoginController;
use LearnPhpMvc\controller\MenuLatihanControllerView;
use LearnPhpMvc\controller\UsersController;
use LearnPhpMvc\controller\UsersControllerView;

//api

//api user
Router::add('GET','/api/user/all',UserController::class,'findALl');
Router::add('POST','/api/user/name',userController::class,"findByName");
Router::add('POST','/api/user/id',userController::class,"findById");
Router::add('POST','/api/user/akses',userController::class,"findByAkases");
Router::add('POST','/api/user/add',userController::class,'addData');
Router::add('POST','/api/user/edit',userController::class,'editData');
Router::add('POST','/api/user/delet',userController::class,'deleteData');

//api alat
Router::add('GET','/api/alat/findAll',AlatController::class,'findAll');
Router::add('POST','/api/alat/findByName',AlatController::class,'findByName');
Router::add('POST','/api/alat/add',AlatController::class,'addData');
Router::add('POST','/api/alat/edit',AlatController::class,'editData');
Router::add('POST','/api/alat/delet',AlatController::class,'deleteData');

//api gerakan
Router::add('POST','/api/gerakan/add',GerakanController::class,'addData');
Router::add('POST','/api/gerakan/edit',GerakanController::class,'editData');
Router::add('POST','/api/gerakan/delete',GerakanController::class,'deleteData');
Router::add('POST','/api/gerakan/id',GerakanController::class,'findById');
Router::add('POST','/api/gerakan/name',GerakanController::class,'findByName');
Router::add('POST','/api/gerakan/alat',GerakanController::class,'findByAlat');
Router::add('GET','/api/gerakan/all',GerakanController::class,'findAll');

//api MenuLatihan
Router::add('GET','/api/menu/all',MenuLatihanController::class,'findAll');
Router::add('POST','/api/menu/rincian',MenuLatihanController::class,'findRincianMenuLatihan');

//api jadwal
Router::add('POST','/api/jadwal/user',JadwalController::class,'findByUser');

//api riwayat
Router::add('POST','/api/riwayat/user',RiwayatController::class,'findRiwayatGerakanByUser');

//w=web
Router::add('GET', '/admin/login', LoginController::class, 'index');
Router::add('GET', '/', LandingPageController::class, 'index');
Router::add('POST', '/submit/login', LoginController::class, 'login');

//admin
Router::add('GET', '/admin', HomeController::class, 'index');
Router::add('GET', '/alat', AlatControllerView::class, 'index');
Router::add('GET', '/user', UsersControllerView::class, 'index');
Router::add('GET', '/gerakan', GerakanControllerView::class, 'index');
Router::add('GET', '/menu', MenuLatihanControllerView::class, 'index');

Router::add('POST', '/company/search', CompanyController::class, 'search');
Router::add('GET', '/company', CompanyController::class, 'bestCompany');
Router::add('GET', '/formlamar', LamarController::class, 'formLamar');
Router::add('GET', '/api/home', CompanyControllerApi::class, 'search');

Router::run();