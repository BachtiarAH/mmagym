<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use LearnPhpMvc\APP\Router;
use LearnPhpMvc\controller\api\AlatController;
use LearnPhpMvc\controller\api\CompanyControllerApi;
use LearnPhpMvc\controller\api\PencariMagang;
// use LearnPhpMvc\controller\api\userContrller;
use LearnPhpMvc\controller\api\userController;
use LearnPhpMvc\controller\CompanyController;
use LearnPhpMvc\controller\HomeController;
use LearnPhpMvc\controller\ProductController;
use LearnPhpMvc\controller\LamarController;
use LearnPhpMvc\controller\LoginController;

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

//w=web

// Router::add('GET', '/', HomeController::class, 'index');
// Router::add('GET', '/hello', HomeController::class, 'hello', [AuthMiddleware::class]);
// Router::add('GET', '/world', HomeController::class, 'world', [AuthMiddleware::class]);
// Router::add('GET', '/about', HomeController::class, 'about');
Router::add('GET', '/login', LoginController::class, 'index');
Router::add('GET', '/', HomeController::class, 'index');

Router::add('POST', '/company/search', CompanyController::class, 'search');
Router::add('GET', '/company', CompanyController::class, 'bestCompany');
Router::add('GET', '/formlamar', LamarController::class, 'formLamar');
Router::add('GET', '/api/home', CompanyControllerApi::class, 'search');

Router::run();