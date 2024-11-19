<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
    $routes->match(['get', 'post'],'/', 'Backend\Home::index');
    $routes->match(['get','post'],'/insertuser', 'Backend\UserController::addUser');
    $routes->match(['get','post'],'/queryuser', 'Backend\UserController::queryUser');
    $routes->match(['get','post'],'/updateuser', 'Backend\UserController::updateUser');
    $routes->match(['get','post'],'/deleteuser', 'Backend\DeleteUser::deleteUser');


    $routes->group('user', static function ($routes) {
        $routes->get('liste', 'DenemeDosyaları\Liste::listem');
        $routes->get('login', 'Backend\Auth::login');
        $routes->get('logout', 'Backend\Auth::logout');
    });

