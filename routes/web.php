<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MatriculadoController;
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
//Route::get('certificados', [CertificadoController::class, 'index'])->name('certificados.index');
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
Route::get('person/edit/{person}', [PersonController::class, 'edit'])->name('person.edit')->middleware('auth');
Route::put('person/update/{person}', [PersonController::class, 'update'])->name('person.update')->middleware('auth');
Route::delete('person/destroy/{person}', [PersonController::class, 'destroy'])->name('person.destroy')->middleware('auth');
Route::get('person/show/{person}', [PersonController::class, 'show'])->name('person.show')->middleware('auth');

//registered
Route::get('registered/index/{id}', [RegisteredController::class, 'index'])->name('registered.index')->middleware('auth');
Route::delete('registered/destroy/{id}', [RegisteredController::class, 'destroy'])->name('registered.destroy')->middleware('auth');
Route::get('registered/matricular/{id}', [RegisteredController::class, 'matricular'])->name('registered.matricular')->middleware('auth');
//export
Route::get('registered/export/{id}', [RegisteredController::class, 'export'])->name('registered.export')->middleware('auth');

//mail
Route::get('mail/send/{id}', [MailController::class, 'sendEmail'])->name('mail.send')->middleware('auth');
Route::get('mail/sendCertificado/{id}', [MailController::class, 'sendCertificado'])->name('mail.sendCertificado')->middleware('auth');

//matriculado
Route::get('matriculados/index', [MatriculadoController::class, 'index'])->name('matriculado.index')->middleware('auth');
Route::get('matriculados/show/{couse}', [MatriculadoController::class, 'show'])->name('matriculados.show')->middleware('auth');
//subirCertificado
Route::post('matriculados/subirCertificado', [MatriculadoController::class, 'subirCertificado'])->name('matriculados.subirCertificado')->middleware('auth');
//export
Route::get('matriculados/export/{id}', [MatriculadoController::class, 'export'])->name('matriculado.export')->middleware('auth');
Route::get('matriculados/editCertificado/{id}', [MatriculadoController::class, 'editCertificado'])->name('matriculados.editCertificado')->middleware('auth');
Route::put('matriculados/updateCertificado', [MatriculadoController::class, 'updateCertificado'])->name('matriculados.updateCertificado')->middleware('auth');
Route::get('matriculados/download/{id}', [MatriculadoController::class, 'download'])->name('matriculados.download')->middleware('auth');
Route::put('matriculados/generarCertificado', [MatriculadoController::class, 'generarCertificado'])->name('matriculados.generarCertificado')->middleware('auth');

//Modulo certificados
Route::get('certificados/certificadoIndex', [CertificadoController::class, 'certificadoIndex'])->name('certificados.certificadoIndex')->middleware('auth');
Route::get('certificados/verLista/{id}', [CertificadoController::class, 'verLista'])->name('certificados.verLista')->middleware('auth');
Route::post('certificados/uploadCertificado', [CertificadoController::class, 'uploadCertificado'])->name('certificados.uploadCertificado')->middleware('auth');
Route::get('certificados/download/{id}', [CertificadoController::class, 'download'])->name('certificados.download')->middleware('auth');