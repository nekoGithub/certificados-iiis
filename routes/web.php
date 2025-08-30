<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::controller(UsuarioController::class)->middleware('auth')->group(function () {
    Route::get('/lista_usuarios', 'lista_usuarios')->name('lista_usuarios');
    Route::post('/crear_usuario',  'crear_usuario')->name('crear_usuario');
    Route::post('/usuario-rol/{id}',  'asignar_rol')->name('asignar_rol');
});

Route::controller(EstudianteController::class)->middleware('auth')->group(function (){
    Route::get('/listar_estudinates', 'listar_estudinates')->name('listar_estudinates');
});

// Rutas API para AJAX
Route::post('/estudiantes', [EstudianteController::class, 'store'])->name('estudiantes.store');
Route::get('/estudiantes/{id}', [EstudianteController::class, 'show'])->name('estudiantes.show');
Route::put('/estudiantes/{id}', [EstudianteController::class, 'update'])->name('estudiantes.update');
Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');

Route::resource('/roles', RoleController::class)->names('roles');
