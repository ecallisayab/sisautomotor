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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/vehiculo_entrada', [App\Http\Controllers\VehiculoEntradaController::class, 'index'])->name('vehiculo_entrada.index');
    Route::get('/vehiculo_entrada/getList', [App\Http\Controllers\VehiculoEntradaController::class, 'getList'])->name('vehiculo_entrada.getList');
    Route::get('/vehiculo_entrada/create', [App\Http\Controllers\VehiculoEntradaController::class, 'create'])->name('vehiculo_entrada.create');
    Route::post('/vehiculo_entrada', [App\Http\Controllers\VehiculoEntradaController::class, 'store'])->name('vehiculo_entrada.store');
    Route::get('/vehiculo_entrada/{id}/edit', [App\Http\Controllers\VehiculoEntradaController::class, 'edit'])->name('vehiculo_entrada.edit');
    Route::put('/vehiculo_entrada/{id}', [App\Http\Controllers\VehiculoEntradaController::class, 'update'])->name('vehiculo_entrada.update');
    Route::delete('/vehiculo_entrada/{id}', [App\Http\Controllers\VehiculoEntradaController::class, 'destroy'])->name('vehiculo_entrada.destroy');
    Route::get('/vehiculo_entrada/{id}/show', [App\Http\Controllers\VehiculoEntradaController::class, 'show'])->name('vehiculo_entrada.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/vehiculo_salida', [App\Http\Controllers\VehiculoSalidaController::class, 'index'])->name('vehiculo_salida.index');
    Route::get('/vehiculo_salida/getList', [App\Http\Controllers\VehiculoSalidaController::class, 'getList'])->name('vehiculo_salida.getList');
    Route::get('/vehiculo_salida/create', [App\Http\Controllers\VehiculoSalidaController::class, 'create'])->name('vehiculo_salida.create');
    Route::post('/vehiculo_salida', [App\Http\Controllers\VehiculoSalidaController::class, 'store'])->name('vehiculo_salida.store');
    Route::get('/vehiculo_salida/{id}/edit', [App\Http\Controllers\VehiculoSalidaController::class, 'edit'])->name('vehiculo_salida.edit');
    Route::put('/vehiculo_salida/{id}', [App\Http\Controllers\VehiculoSalidaController::class, 'update'])->name('vehiculo_salida.update');
    Route::delete('/vehiculo_salida/{id}', [App\Http\Controllers\VehiculoSalidaController::class, 'destroy'])->name('vehiculo_salida.destroy');
    Route::get('/vehiculo_salida/{id}/show', [App\Http\Controllers\VehiculoSalidaController::class, 'show'])->name('vehiculo_salida.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/vehiculo_entrada', [App\Http\Controllers\VehiculoEntradaController::class, 'index'])->name('vehiculo_entrada.index');
    Route::get('/vehiculo_entrada/getList', [App\Http\Controllers\VehiculoEntradaController::class, 'getList'])->name('vehiculo_entrada.getList');
    Route::get('/vehiculo_entrada/create', [App\Http\Controllers\VehiculoEntradaController::class, 'create'])->name('vehiculo_entrada.create');
    Route::post('/vehiculo_entrada', [App\Http\Controllers\VehiculoEntradaController::class, 'store'])->name('vehiculo_entrada.store');
    Route::get('/vehiculo_entrada/{id}/edit', [App\Http\Controllers\VehiculoEntradaController::class, 'edit'])->name('vehiculo_entrada.edit');
    Route::put('/vehiculo_entrada/{id}', [App\Http\Controllers\VehiculoEntradaController::class, 'update'])->name('vehiculo_entrada.update');
    Route::delete('/vehiculo_entrada/{id}', [App\Http\Controllers\VehiculoEntradaController::class, 'destroy'])->name('vehiculo_entrada.destroy');
    Route::get('/vehiculo_entrada/{id}/show', [App\Http\Controllers\VehiculoEntradaController::class, 'show'])->name('vehiculo_entrada.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/tipo_mantenimiento', [App\Http\Controllers\TipoMantenimientoController::class, 'index'])->name('tipo_mantenimiento.index');
    Route::get('/tipo_mantenimiento/getList', [App\Http\Controllers\TipoMantenimientoController::class, 'getList'])->name('tipo_mantenimiento.getList');
    Route::get('/tipo_mantenimiento/create', [App\Http\Controllers\TipoMantenimientoController::class, 'create'])->name('tipo_mantenimiento.create');
    Route::post('/tipo_mantenimiento', [App\Http\Controllers\TipoMantenimientoController::class, 'store'])->name('tipo_mantenimiento.store');
    Route::get('/tipo_mantenimiento/{id}/edit', [App\Http\Controllers\TipoMantenimientoController::class, 'edit'])->name('tipo_mantenimiento.edit');
    Route::put('/tipo_mantenimiento/{id}', [App\Http\Controllers\TipoMantenimientoController::class, 'update'])->name('tipo_mantenimiento.update');
    Route::delete('/tipo_mantenimiento/{id}', [App\Http\Controllers\TipoMantenimientoController::class, 'destroy'])->name('tipo_mantenimiento.destroy');
    Route::get('/tipo_mantenimiento/{id}/show', [App\Http\Controllers\TipoMantenimientoController::class, 'show'])->name('tipo_mantenimiento.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/mantenimiento', [App\Http\Controllers\MantenimientoController::class, 'index'])->name('mantenimiento.index');
    Route::get('/mantenimiento/getList', [App\Http\Controllers\MantenimientoController::class, 'getList'])->name('mantenimiento.getList');
    Route::get('/mantenimiento/create', [App\Http\Controllers\MantenimientoController::class, 'create'])->name('mantenimiento.create');
    Route::post('/mantenimiento', [App\Http\Controllers\MantenimientoController::class, 'store'])->name('mantenimiento.store');
    Route::get('/mantenimiento/{id}/edit', [App\Http\Controllers\MantenimientoController::class, 'edit'])->name('mantenimiento.edit');
    Route::put('/mantenimiento/{id}', [App\Http\Controllers\MantenimientoController::class, 'update'])->name('mantenimiento.update');
    Route::delete('/mantenimiento/{id}', [App\Http\Controllers\MantenimientoController::class, 'destroy'])->name('mantenimiento.destroy');
    Route::get('/mantenimiento/{id}/show', [App\Http\Controllers\MantenimientoController::class, 'show'])->name('mantenimiento.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/seguimiento_mantenimiento', [App\Http\Controllers\SeguimientoMantenimientoController::class, 'index'])->name('seguimiento_mantenimiento.index');
    Route::get('/seguimiento_mantenimiento/getList', [App\Http\Controllers\SeguimientoMantenimientoController::class, 'getList'])->name('seguimiento_mantenimiento.getList');
    Route::get('/seguimiento_mantenimiento/create', [App\Http\Controllers\SeguimientoMantenimientoController::class, 'create'])->name('seguimiento_mantenimiento.create');
    Route::post('/seguimiento_mantenimiento', [App\Http\Controllers\SeguimientoMantenimientoController::class, 'store'])->name('seguimiento_mantenimiento.store');
    Route::get('/seguimiento_mantenimiento/{id}/edit', [App\Http\Controllers\SeguimientoMantenimientoController::class, 'edit'])->name('seguimiento_mantenimiento.edit');
    Route::put('/seguimiento_mantenimiento/{id}', [App\Http\Controllers\SeguimientoMantenimientoController::class, 'update'])->name('seguimiento_mantenimiento.update');
    Route::delete('/seguimiento_mantenimiento/{id}', [App\Http\Controllers\SeguimientoMantenimientoController::class, 'destroy'])->name('seguimiento_mantenimiento.destroy');
    Route::get('/seguimiento_mantenimiento/{id}/show', [App\Http\Controllers\SeguimientoMantenimientoController::class, 'show'])->name('seguimiento_mantenimiento.show');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/programa_mantenimiento', [App\Http\Controllers\ProgramaMantenimientoController::class, 'index'])->name('programa_mantenimiento.index');
    Route::get('/programa_mantenimiento/getList', [App\Http\Controllers\ProgramaMantenimientoController::class, 'getList'])->name('programa_mantenimiento.getList');
    Route::get('/programa_mantenimiento/create', [App\Http\Controllers\ProgramaMantenimientoController::class, 'create'])->name('programa_mantenimiento.create');
    Route::post('/programa_mantenimiento', [App\Http\Controllers\ProgramaMantenimientoController::class, 'store'])->name('programa_mantenimiento.store');
    Route::get('/programa_mantenimiento/{id}/edit', [App\Http\Controllers\ProgramaMantenimientoController::class, 'edit'])->name('programa_mantenimiento.edit');
    Route::put('/programa_mantenimiento/{id}', [App\Http\Controllers\ProgramaMantenimientoController::class, 'update'])->name('programa_mantenimiento.update');
    Route::delete('/programa_mantenimiento/{id}', [App\Http\Controllers\ProgramaMantenimientoController::class, 'destroy'])->name('programa_mantenimiento.destroy');
    Route::get('/programa_mantenimiento/{id}/show', [App\Http\Controllers\ProgramaMantenimientoController::class, 'show'])->name('programa_mantenimiento.show');
});