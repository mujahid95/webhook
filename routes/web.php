<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/admin/dashboard', function () {
//    return view('dashboard');
//});

Route::group(['prefix' => 'api'], fn() => [
    Route::get('users', [UserController::class, 'index']),
    Route::post('create/user', [UserController::class, 'store']),
]);

Route::get('{view}', \App\Http\Controllers\ApplicationController::class)->where('view', '(.*)');

