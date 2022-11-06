<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use LearnPhpMvc\APP\Router;
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
Router::add('GET', '/api/test', ProductController::class, 'categories');
Router::add('POST', '/api/add', ProductController::class, 'postCategories');
Router::add('GET', '/api/pencari-magang/all', PencariMagang::class, 'findAll');
Router::add('GET','/api/mmagym/userAll',UserController::class,'findALl');

//w=web

// Router::add('GET', '/', HomeController::class, 'index');
// Router::add('GET', '/hello', HomeController::class, 'hello', [AuthMiddleware::class]);
// Router::add('GET', '/world', HomeController::class, 'world', [AuthMiddleware::class]);
// Router::add('GET', '/about', HomeController::class, 'about');
Router::add('GET', '/', LoginController::class, 'index');

Router::add('POST', '/company/search', CompanyController::class, 'search');
Router::add('GET', '/company', CompanyController::class, 'bestCompany');
Router::add('GET', '/formlamar', LamarController::class, 'formLamar');
Router::add('GET', '/api/home', CompanyControllerApi::class, 'search');

Router::run();