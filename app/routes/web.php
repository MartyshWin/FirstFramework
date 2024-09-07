<?php

global $request;

use App\Http\Route;
use App\Controllers\SearchController;
use App\Controllers\UserController;
use App\Controllers\HomeController;

$routes[] = Route::get('/', [HomeController::class, 'index'], $request);
$routes[] = Route::get('/user/{id}', [UserController::class, 'index'], $request);
$routes[] = Route::get('/user/{id}/{method}', [UserController::class, 'index'], $request);
$routes[] = Route::post('/search/date', [SearchController::class, 'getDate'], $request);



foreach ($routes as $elem) {
    if ($elem !== null) {
        $route = $elem;
        break;
    }else
        $route = null;
}

if (is_null($route)) {
    $route = Route::not_found($_SERVER['REQUEST_URI'], $request);
}

$route->render();