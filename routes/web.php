<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/vehiculo', [App\Http\Controllers\VehiculoController::class, 'index'])->name('vehiculo.index');
    Route::get('/vehiculo/getList', [App\Http\Controllers\VehiculoController::class, 'getList'])->name('vehiculo.getList');
    Route::get('/vehiculo/create', [App\Http\Controllers\VehiculoController::class, 'create'])->name('vehiculo.create');
    Route::post('/vehiculo', [App\Http\Controllers\VehiculoController::class, 'store'])->name('vehiculo.store');
    Route::get('/vehiculo/{id}/edit', [App\Http\Controllers\VehiculoController::class, 'edit'])->name('vehiculo.edit');
    Route::put('/vehiculo/{id}', [App\Http\Controllers\VehiculoController::class, 'update'])->name('vehiculo.update');
    Route::delete('/vehiculo/{id}', [App\Http\Controllers\VehiculoController::class, 'destroy'])->name('vehiculo.destroy');
    Route::get('/vehiculo/{id}/show', [App\Http\Controllers\VehiculoController::class, 'show'])->name('vehiculo.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/getList', [App\Http\Controllers\ProductController::class, 'getList'])->name('products.getList');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}/show', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/combustible', [App\Http\Controllers\CombustibleController::class, 'index'])->name('combustible.index');
    Route::get('/combustible/getList', [App\Http\Controllers\CombustibleController::class, 'getList'])->name('combustible.getList');
    Route::get('/combustible/create', [App\Http\Controllers\CombustibleController::class, 'create'])->name('combustible.create');
    Route::post('/combustible', [App\Http\Controllers\CombustibleController::class, 'store'])->name('combustible.store');
    Route::get('/combustible/{id}/edit', [App\Http\Controllers\CombustibleController::class, 'edit'])->name('combustible.edit');
    Route::put('/combustible/{id}', [App\Http\Controllers\CombustibleController::class, 'update'])->name('combustible.update');
    Route::delete('/combustible/{id}', [App\Http\Controllers\CombustibleController::class, 'destroy'])->name('combustible.destroy');
    Route::get('/combustible/{id}/show', [App\Http\Controllers\CombustibleController::class, 'show'])->name('combustible.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/proveedor', [App\Http\Controllers\ProveedorController::class, 'index'])->name('proveedor.index');
    Route::get('/proveedor/getList', [App\Http\Controllers\ProveedorController::class, 'getList'])->name('proveedor.getList');
    Route::get('/proveedor/create', [App\Http\Controllers\ProveedorController::class, 'create'])->name('proveedor.create');
    Route::post('/proveedor', [App\Http\Controllers\ProveedorController::class, 'store'])->name('proveedor.store');
    Route::get('/proveedor/{id}/edit', [App\Http\Controllers\ProveedorController::class, 'edit'])->name('proveedor.edit');
    Route::put('/proveedor/{id}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('proveedor.update');
    Route::delete('/proveedor/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])->name('proveedor.destroy');
    Route::get('/proveedor/{id}/show', [App\Http\Controllers\ProveedorController::class, 'show'])->name('proveedor.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/permiso', [App\Http\Controllers\PermisoController::class, 'index'])->name('permiso.index');
    Route::get('/permiso/getList', [App\Http\Controllers\PermisoController::class, 'getList'])->name('permiso.getList');
    Route::get('/permiso/create', [App\Http\Controllers\PermisoController::class, 'create'])->name('permiso.create');
    Route::post('/permiso', [App\Http\Controllers\PermisoController::class, 'store'])->name('permiso.store');
    Route::get('/permiso/{id}/edit', [App\Http\Controllers\PermisoController::class, 'edit'])->name('permiso.edit');
    Route::put('/permiso/{id}', [App\Http\Controllers\PermisoController::class, 'update'])->name('permiso.update');
    Route::delete('/permiso/{id}', [App\Http\Controllers\PermisoController::class, 'destroy'])->name('permiso.destroy');
    Route::get('/permiso/{id}/show', [App\Http\Controllers\PermisoController::class, 'show'])->name('permiso.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/repuesto', [App\Http\Controllers\RepuestoController::class, 'index'])->name('repuesto.index');
    Route::get('/repuesto/getList', [App\Http\Controllers\RepuestoController::class, 'getList'])->name('repuesto.getList');
    Route::get('/repuesto/create', [App\Http\Controllers\RepuestoController::class, 'create'])->name('repuesto.create');
    Route::post('/repuesto', [App\Http\Controllers\RepuestoController::class, 'store'])->name('repuesto.store');
    Route::get('/repuesto/{id}/edit', [App\Http\Controllers\RepuestoController::class, 'edit'])->name('repuesto.edit');
    Route::put('/repuesto/{id}', [App\Http\Controllers\RepuestoController::class, 'update'])->name('repuesto.update');
    Route::delete('/repuesto/{id}', [App\Http\Controllers\RepuestoController::class, 'destroy'])->name('repuesto.destroy');
    Route::get('/repuesto/{id}/show', [App\Http\Controllers\RepuestoController::class, 'show'])->name('repuesto.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/combustible_entrada', [App\Http\Controllers\CombustibleEntradaController::class, 'index'])->name('combustible_entrada.index');
    Route::get('/combustible_entrada/getList', [App\Http\Controllers\CombustibleEntradaController::class, 'getList'])->name('combustible_entrada.getList');
    Route::get('/combustible_entrada/create', [App\Http\Controllers\CombustibleEntradaController::class, 'create'])->name('combustible_entrada.create');
    Route::post('/combustible_entrada', [App\Http\Controllers\CombustibleEntradaController::class, 'store'])->name('combustible_entrada.store');
    Route::get('/combustible_entrada/{id}/edit', [App\Http\Controllers\CombustibleEntradaController::class, 'edit'])->name('combustible_entrada.edit');
    Route::put('/combustible_entrada/{id}', [App\Http\Controllers\CombustibleEntradaController::class, 'update'])->name('combustible_entrada.update');
    Route::delete('/combustible_entrada/{id}', [App\Http\Controllers\CombustibleEntradaController::class, 'destroy'])->name('combustible_entrada.destroy');
    Route::get('/combustible_entrada/{id}/show', [App\Http\Controllers\CombustibleEntradaController::class, 'show'])->name('combustible_entrada.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/combustible_salida', [App\Http\Controllers\CombustibleSalidaController::class, 'index'])->name('combustible_salida.index');
    Route::get('/combustible_salida/getList', [App\Http\Controllers\CombustibleSalidaController::class, 'getList'])->name('combustible_salida.getList');
    Route::get('/combustible_salida/create', [App\Http\Controllers\CombustibleSalidaController::class, 'create'])->name('combustible_salida.create');
    Route::post('/combustible_salida', [App\Http\Controllers\CombustibleSalidaController::class, 'store'])->name('combustible_salida.store');
    Route::get('/combustible_salida/{id}/edit', [App\Http\Controllers\CombustibleSalidaController::class, 'edit'])->name('combustible_salida.edit');
    Route::put('/combustible_salida/{id}', [App\Http\Controllers\CombustibleSalidaController::class, 'update'])->name('combustible_salida.update');
    Route::delete('/combustible_salida/{id}', [App\Http\Controllers\CombustibleSalidaController::class, 'destroy'])->name('combustible_salida.destroy');
    Route::get('/combustible_salida/{id}/show', [App\Http\Controllers\CombustibleSalidaController::class, 'show'])->name('combustible_salida.show');
});