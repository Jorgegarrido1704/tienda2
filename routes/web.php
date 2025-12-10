<?php

use App\Http\Controllers\home;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login.index');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/login', 'login')->name('login.login');

});
Route::controller(home::class)->group(function () {
    Route::get('/home', 'index')->name('home.index');
});
Route::controller(VentaController::class)->group(function () {
    Route::get('/venta', 'index')->name('venta.index');
    Route::get('/imprimir', 'imprimir')->name('venta.imprimir');
});
