<?php


use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\GaleriaController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);

// Relatórios PDF
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios');
Route::get('/relatorios/gerar-pdf', [RelatorioController::class, 'gerarPdf'])->name('relatorios.pdf');

// Galeria de Fotos/Vídeos
Route::get('/galeria', [GaleriaController::class, 'index'])->name('galeria');


// Rotas de autenticação (já devem existir)
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');