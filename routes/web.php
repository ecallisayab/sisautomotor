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

Route::get('/vehiculos', [App\Http\Controllers\VehiculoController::class, 'index'])->name('vehiculo.index');
Route::get('/vehiculos/create', [App\Http\Controllers\VehiculoController::class, 'create'])->name('vehiculo.create');

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
