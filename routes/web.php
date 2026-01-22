<?php

use App\Http\Controllers\AbonoController;
use App\Http\Controllers\home;
use App\Http\Controllers\InventarioController;
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
    Route::get('/fetchProducts', 'fetchProducts')->name('venta.fetchProducts');
    Route::get('/precio', 'getPrice')->name('venta.getPrice');
    Route::post('/create', 'create')->name('venta.create');
    Route::post('/store', 'store')->name('venta.store');
    Route::get(('/verVentas'), 'verVentas')->name('venta.verVentas');
    Route::get('/fetchClientes', 'fetchClientes')->name('venta.fetchClientes');
    Route::get('/venta/EditarInformacion', 'EditarInformacion')->name('venta.EditarInformacion');
    Route::post('/venta/edicion', 'edicion')->name('venta.edicion');
});

Route::controller(AbonoController::class)->group(function () {
    Route::get('/abono', 'index')->name('abono.index');
    Route::post('/abono/datos', 'datos')->name('abono.datos');
    Route::post('/abono/store', 'store')->name('abono.store');
    Route::post('/abono/editarAbono', 'editarAbono')->name('abono.editarAbono');
});
Route::controller(InventarioController::class)->group(function () {
    Route::get('/inventario', 'index')->name('inventario.index');
    Route::get('/inventario/datoscategorias', 'datoscategorias')->name('inventario.datoscategorias');
    Route::get('/inventario/datoGeneralesProducto/{id}', 'datoGeneralesProducto')->name('inventario.datoGeneralesProducto');
    Route::post('/inventario/datoGeneralesProducto/actualizarProducto/', 'actualizarProducto')->name('inventario.actualizarProducto');
    Route::get('/inventario/agregarProducto', 'agregarProducto')->name('inventario.agregarProducto');
});
Route::controller(ReportesController::class)->group(function () {
    Route::get('/reportes', 'index')->name('reportes.index');
});
