<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\MonitoringController;

/*
|--------------------------------------------------------------------------
| Web Routes - Koin Kene Application
|--------------------------------------------------------------------------
*/

// ============================================
// HALAMAN PUBLIK
// ============================================
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ============================================
// ROUTES UNTUK GUEST (Belum Login)
// ============================================
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    // Register Routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// ============================================
// ROUTES UNTUK USER YANG SUDAH LOGIN
// ============================================
Route::middleware('auth')->group(function () {
    
    // ========== Authentication ==========
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // ========== Dashboard ==========
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ========== Transaksi (CRUD Lengkap) ==========
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('index');
        Route::post('/', [TransaksiController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TransaksiController::class, 'update'])->name('update');
        Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('destroy');
    });
    
    // ========== Laporan Keuangan ==========
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/generate', [LaporanController::class, 'generate'])->name('generate');
        Route::get('/export', [LaporanController::class, 'exportPDF'])->name('export');
    });
    
    // ========== Kwitansi ==========
    Route::prefix('kwitansi')->name('kwitansi.')->group(function () {
        Route::get('/', [KwitansiController::class, 'index'])->name('index');
        Route::post('/', [KwitansiController::class, 'store'])->name('store');
        Route::get('/pdf/{id}', [KwitansiController::class, 'exportPdf'])->name('pdf');
        Route::delete('/{id}', [KwitansiController::class, 'destroy'])->name('destroy');
    });
    
    // ========== Monitoring Saldo ==========
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
});

// ============================================
// FALLBACK ROUTE (404)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});