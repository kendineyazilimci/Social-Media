<?php

use App\Controllers\Backend\AdminController;
use App\Controllers\Backend\Controllerbir;
use CodeIgniter\Controller;
use App\Controllers\Backend\Home;
use App\Controllers\Backend\insertUser;
use App\Controllers\Backend\LoginController;
use App\Controllers\Backend\QueryUser;
use App\Controllers\Backend\SessionController;
use App\Controllers\Backend\UpdateUser;
use App\Controllers\Backend\YonlendirmeController;
use CodeIgniter\Commands\Utilities\Routes;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->match(['get','post'],'/anasayfa', [Home::class, 'index']);

$routes->match(['get', 'post'], 'giriss', [SessionController::class, 'index']);


$routes->match(['get', 'post'], 'giris', [LoginController::class, 'giris']);
$routes->match(['get', 'post'], 'uyelik', [LoginController::class, 'uyelik']);
$routes->match(['get', 'post'], 'cikis', [LoginController::class, 'cikis']);

$routes->group('admin');{
    $routes->match(['get','post'],'admin', [AdminController::class, 'index']);
    $routes->match(['get','post'],'admin/crud', [AdminController::class, 'index']);
    $routes->match(['get','post'],'admin/deleteuser', [DeleteUser::class, 'deleteuser']);
    $routes->match(['get','post'],'admin/insertuser', [InsertUser::class, 'insertuser']);
    $routes->match(['get','post'],'admin/queryuser', [QueryUser::class, 'queryuser']);
    $routes->match(['get','post'],'admin/updateuser', [UpdateUser::class, 'updateuser']);
    $routes->match(['get','post'],'admin/site', [AdminController::class, 'index']);};


