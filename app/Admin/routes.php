<?php

use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\FileController;
use App\Admin\Controllers\PostController;
use App\Admin\Controllers\SiteController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('sites/options', [SiteController::class, 'options']);
    $router->resource('sites', SiteController::class);

    $router->get('categories/options', [CategoryController::class, 'options']);
    $router->resource('categories', CategoryController::class);
    $router->resource('posts', PostController::class);
    $router->post('file/upload-by-url',[FileController::class, 'uploadByUrl']);
    $router->post('file/upload-by-file',[FileController::class, 'uploadByFile']);

});