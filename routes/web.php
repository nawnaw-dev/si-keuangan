<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\KwitansiController;

Route::get('/', function () {
    return view('welcome');
});

// Login routes harus di luar closure
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');

// Halaman utama laporan keuangan
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

// Generate laporan berdasarkan bulan & tahun (pakai query string ?periode=YYYY-MM)
Route::get('/laporan/generate', [LaporanController::class, 'generate'])->name('laporan.generate');

// Export laporan ke PDF
Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

// Monitoring
//Route::get('/monitoring-saldo', [MonitoringController::class, 'index'])->name('monitoring');
Route::get('/monitoring', function () {
    return view('monitoring');
})->name('monitoring');

// Kwitansi
Route::get('/kwitansi', [KwitansiController::class, 'index'])->name('kwitansi.index');
Route::post('/kwitansi', [KwitansiController::class, 'store'])->name('kwitansi.store');
Route::get('/kwitansi/pdf/{id}', [KwitansiController::class, 'exportPdf'])->name('kwitansi.pdf');
