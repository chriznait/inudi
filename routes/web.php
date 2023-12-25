<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\RegisteredController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CertificadoController::class, 'index'])->name('certificados.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/usuarios', [App\Http\Controllers\Admin\UsuariosController::class, 'index'])->name('admin.usuarios');
Route::get('admin/create', [App\Http\Controllers\Admin\UsuariosController::class, 'create'])->name('admin.create');

Route::get('admin/crear', [App\Http\Controllers\Admin\UsuariosController::class, 'crear'])->name('admin.crear');
Route::post('admin/store', [App\Http\Controllers\Admin\UsuariosController::class, 'store'])->name('admin.store');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

//CREAR RUTA PARA USUARIOS ADMINISTRADORES

//ROUTE COURSE
Route::get('courses/index', [CourseController::class, 'index'])->name('courses.index')->middleware('auth');
Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create')->middleware('auth');
Route::post('courses/store', [CourseController::class, 'store'])->name('courses.store')->middleware('auth');
Route::get('courses/edit/{course}', [CourseController::class, 'edit'])->name('courses.edit')->middleware('auth');
Route::put('courses/update/{course}', [CourseController::class, 'update'])->name('courses.update')->middleware('auth');
Route::delete('courses/destroy/{course}', [CourseController::class, 'destroy'])->name('courses.destroy')->middleware('auth');
Route::get('courses/show/{course}', [CourseController::class, 'show'])->name('courses.show')->middleware('auth');

//ROUTE CERTIFICATE
//Route::get('certificados/index', [CertificadoController::class, 'index'])->name('certificados.index');
Route::get('certificados', [CertificadoController::class, 'index'])->name('certificados.index');
Route::get('certificados/verificar', [CertificadoController::class, 'verificar'])->name('certificados.verificar');
Route::get('certificados/{id}/departamento', [CertificadoController::class, 'getDepartamento']);
Route::get('certificados/{id}/provincia', [CertificadoController::class, 'getProvincia']);
Route::get('certificados/{id}/distrito', [CertificadoController::class, 'getDistrito']);
Route::post('certificados/store', [CertificadoController::class, 'store'])->name('certificados.store');
Route::put('certificados/update/{id}', [CertificadoController::class, 'update'])->name('certificados.update');
Route::get('certificados/buscar', [CertificadoController::class, 'buscar'])->name('certificados.buscar');
Route::get('certificados/ver/{id}', [CertificadoController::class, 'ver'])->name('certificados.ver');

//person
Route::get('person/index', [PersonController::class, 'index'])->name('person.index')->middleware('auth');
Route::get('person/create', [PersonController::class, 'create'])->name('person.create')->middleware('auth');
Route::post('person/store', [PersonController::class, 'store'])->name('person.store')->middleware('auth');

//registered
Route::get('registered/index/{id}', [RegisteredController::class, 'index'])->name('registered.index')->middleware('auth');
Route::delete('registered/destroy/{id}', [RegisteredController::class, 'destroy'])->name('registered.destroy')->middleware('auth');