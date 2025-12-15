<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\MonitoringController;

// Halaman Welcome/Landing
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// ============================================
// ROUTES UNTUK GUEST (Belum Login)
// ============================================
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ============================================
// ROUTES UNTUK USER YANG SUDAH LOGIN
// ============================================
Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    // Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    
    // Laporan Keuangan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/generate', [LaporanController::class, 'generate'])->name('laporan.generate');
    Route::get('/laporan/export', [LaporanController::class, 'exportPDF'])->name('laporan.export');
    
    // Kwitansi
    Route::get('/kwitansi', [KwitansiController::class, 'index'])->name('kwitansi.index');
    Route::post('/kwitansi', [KwitansiController::class, 'store'])->name('kwitansi.store');
    Route::get('/kwitansi/pdf/{id}', [KwitansiController::class, 'exportPdf'])->name('kwitansi.pdf');
    
    // Monitoring Saldo
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
});