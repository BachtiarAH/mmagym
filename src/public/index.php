<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use LearnPhpMvc\APP\Router;
use LearnPhpMvc\controller\AlatControllerView;
use LearnPhpMvc\controller\api\AlatController;
use LearnPhpMvc\controller\api\AuthController;
use LearnPhpMvc\controller\api\CompanyControllerApi;
use LearnPhpMvc\controller\api\GerakanController;
use LearnPhpMvc\controller\api\JadwalController;
use LearnPhpMvc\controller\api\MenuLatihanController;
use LearnPhpMvc\controller\api\PencariMagang;
use LearnPhpMvc\controller\api\RiwayatController;
use LearnPhpMvc\controller\api\TesController;
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

//auth
Router::add('POST','/api/auth/login/admin',AuthController::class,'loginAdmin');
Router::add('POST','/api/auth/login',AuthController::class,'login');
Router::add('POST','/api/auth/register',AuthController::class,'register');
Router::add('POST','/api/auth/register/verif',AuthController::class,'verifyOtp');
Router::add('POST','/api/auth/resetpassword/sendOtp',AuthController::class,'sendOtpResetPassword');
Router::add('POST','/api/auth/sendOtp',AuthController::class,'sendOtpAgain');
Router::add('POST','/api/auth/resetpassword/setpassword',AuthController::class,'resetPassword');
Router::add('POST','/api/auth/cekotp',AuthController::class,'cekOtp');

//tes
Router::add('POST','/api/tes/drive/delete',TesController::class,'deleteGoogleDriveFile');
Router::add('POST','/api/tes/drive/replace',TesController::class,'replaceGoogleDrifeFile');
Router::add('POST','/api/tes/drive/create',TesController::class,'createGDriveFile');

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
Router::add('POST','/api/alat/name',AlatController::class,'findByName');
Router::add('POST','/api/alat/add',AlatController::class,'addData');
Router::add('POST','/api/alat/edit',AlatController::class,'editData');
Router::add('POST','/api/alat/delet',AlatController::class,'deleteData');
Router::add('POST','/api/alat/edit/nama',AlatController::class, 'editNameData');
Router::add('POST','/api/alat/tesfile',AlatController::class, 'tesFile');
Router::add('POST','/api/alat/tesUpload',AlatController::class, 'uploadBasic');

//api gerakan
Router::add('POST','/api/gerakan/add',GerakanController::class,'addData');
Router::add('POST','/api/gerakan/edit',GerakanController::class,'editData');
Router::add('POST','/api/gerakan/edit/noFile',GerakanController::class,'editNoFIle');
Router::add('POST','/api/gerakan/edit/Withfot',GerakanController::class,'editdataWithFoto');
Router::add('POST','/api/gerakan/edit/Withvid',GerakanController::class,'editDataWithVideo');
Router::add('POST','/api/gerakan/delete',GerakanController::class,'deleteData');
Router::add('POST','/api/gerakan/id',GerakanController::class,'findById');
Router::add('POST','/api/gerakan/name',GerakanController::class,'findByName');
Router::add('POST','/api/gerakan/alat',GerakanController::class,'findByAlat');
Router::add('GET','/api/gerakan/all',GerakanController::class,'findAll');

//api MenuLatihan
Router::add('GET','/api/menu/all',MenuLatihanController::class,'findAll');
Router::add('POST','/api/menu/rincian',MenuLatihanController::class,'findRincianMenuLatihan');
Router::add('POST','/api/menu/add',MenuLatihanController::class,'addData');
Router::add('POST','/api/menu/update',MenuLatihanController::class,'editData');
Router::add('POST','/api/menu/updateNoFot',MenuLatihanController::class,'editNoGambar');
Router::add('POST','/api/menu/delete',MenuLatihanController::class,'deleteData');
Router::add('POST','/api/menu/add/rincian',MenuLatihanController::class,'addRician');
Router::add('POST','/api/menu/delete/rincian',MenuLatihanController::class,'deleteDataRincian');
Router::add('POST','/api/menu/update/rincian',MenuLatihanController::class,'updateDataRincian');
Router::add('GET','/api/menu/id',MenuLatihanController::class,'findById');

//api jadwal
Router::add('POST','/api/jadwal/user',JadwalController::class,'findByUser');
Router::add('POST','/api/jadwal/user/add',JadwalController::class,'addData');
Router::add('GET','/api/jadwal/user',JadwalController::class,'findByIdUser');

//api riwayat
Router::add('POST','/api/riwayat/user',RiwayatController::class,'findRiwayatGerakanByUser');
Router::add('POST','/api/riwayat/add',RiwayatController::class,'addRiwayat');



//web
Router::add('GET', '/admin/login', LoginController::class, 'index');
Router::add('GET', '/', LandingPageController::class, 'index');
Router::add('POST', '/submit/login', LoginController::class, 'login');
Router::add('GET', '/logout', LoginController::class, 'logOut');

//admin
Router::add('GET', '/admin', HomeController::class, 'index');
Router::add('POST', '/admin', HomeController::class, 'index');
Router::add('POST', '/admin/editProfil', HomeController::class, 'editDataProfil');

//alat
Router::add('GET', '/alat', AlatControllerView::class, 'index');
Router::add('POST', '/alat/update', AlatControllerView::class, 'update');
Router::add('POST', '/alat/add', AlatControllerView::class, 'add');
Router::add('GET', '/alat/delete', AlatControllerView::class, 'delete');

//user
Router::add('GET', '/user', UsersControllerView::class, 'index');
Router::add('POST', '/user/add', UsersControllerView::class, 'add');
Router::add('POST', '/user/edit', UsersControllerView::class, 'edit');
Router::add('GET', '/user/delete', UsersControllerView::class, 'delete');

//gerakan
Router::add('GET', '/gerakan', GerakanControllerView::class, 'index');
Router::add('POST', '/gerakan/add', GerakanControllerView::class, 'addData');
Router::add('POST', '/gerakan/edit', GerakanControllerView::class, 'edit');
Router::add('GET', '/gerakan/delete', GerakanControllerView::class, 'delete');

//menu latihan
Router::add('GET', '/menu', MenuLatihanControllerView::class, 'index');
Router::add('GET', '/menu/delete', MenuLatihanControllerView::class, 'deletData');
Router::add('GET', '/menuAdd', MenuLatihanControllerView::class, 'renderAdd');
Router::add('GET', '/menuAdd/delete', MenuLatihanControllerView::class, 'deleteRincian');
Router::add('POST', '/menuAdd/edit', MenuLatihanControllerView::class, 'editRincian');
Router::add('POST', '/menu/add', MenuLatihanControllerView::class, 'add');
Router::add('POST', '/menu/edit', MenuLatihanControllerView::class, 'edit');
Router::add('POST', '/menu/add/rincian', MenuLatihanControllerView::class, 'rincianMenuAdd');

Router::add('POST', '/company/search', CompanyController::class, 'search');
Router::add('GET', '/company', CompanyController::class, 'bestCompany');
Router::add('GET', '/formlamar', LamarController::class, 'formLamar');
Router::add('GET', '/api/home', CompanyControllerApi::class, 'search');

Router::run();