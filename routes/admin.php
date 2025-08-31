<?php

use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Certificados\ConfigurarCertificado;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/perfil', function () {
        return view('admin.perfil');
    })->name('perfil');
});

Route::get('certificados', [CertificadoController::class, 'index'])->name('certificados.index');

Route::get('/certificados/{certificado}/configurar', ConfigurarCertificado::class)
    ->name('certificados.configurar');

Route::get('/certificados/{certificado}/generar-pdf', [CertificadoController::class, 'generarPDF'])
    ->name('certificados.generar-pdf');

Route::get('/certificados/{certificado}/preview-pdf', [CertificadoController::class, 'previewPDF'])
    ->name('certificados.preview-pdf');

