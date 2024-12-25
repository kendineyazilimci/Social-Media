<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->match(['get','post'],'/anasayfa', [\App\Controllers\Home::class, 'index']);

$routes->match(['get', 'post'], 'chat', [\App\Controllers\ChatController::class, 'chat']);
$routes->post('chat/sendMessage', [\App\Controllers\ChatController::class, 'sendMessage']);

$routes->match(['get', 'post'], 'giris', [\App\Controllers\LoginController::class, 'giris']);
$routes->match(['get', 'post'], 'uyelik', [\App\Controllers\LoginController::class, 'uyelik']);
$routes->match(['get', 'post'], 'cikis', [\App\Controllers\LoginController::class, 'cikis']);
    
$routes->group('admin', function($routes){
    $routes->match(['get','post'], 'login', [\App\Controllers\AdminController::class, 'login']);
    $routes->match(['get','post'], 'crud', [\App\Controllers\AdminController::class, 'crud']);
    $routes->match(['get','post'], 'crud/insertuser', [\App\Controllers\InsertUserController::class, 'insertUser']);
    $routes->match(['get','post'], 'crud/deleteuser', [\App\Controllers\DeleteUserController::class, 'deleteUser']);
    $routes->match(['get','post'], 'crud/queryuser', [\App\Controllers\AdminController::class, 'crud']);
    $routes->match(['get','post'], 'crud/updateuser', [\App\Controllers\AdminController::class, 'crud']);
    $routes->match(['get','post'], 'crud/kullanicilistele', [\App\Controllers\AdminController::class, 'crud']);
    $routes->match(['get','post'], 'crud/manageuser', [\App\Controllers\DeleteUserController::class, 'manageUser']);
});