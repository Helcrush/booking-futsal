<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Dashboard Arena Futsal
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE PUBLIC (Landing Page & Booking Mandiri)
// ==========================================
Route::get('/', function () {
    // Jika admin sudah login, kunci di dashboard
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('welcome');
});

Route::get('/jadwal/tersedia', [JadwalController::class, 'jadwalTersedia']); 
Route::get('/booking-mandiri', [TransaksiController::class, 'createPublic'])->name('booking.create');
Route::post('/booking-mandiri', [TransaksiController::class, 'storePublic'])->name('booking.store');

// ==========================================
// 2. RUTE PROTECTED ADMIN (Prefix: /admin/...)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('lapangan', LapanganController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('penyewa', PenyewaController::class);
    Route::resource('member', MemberController::class);
    Route::resource('transaksi', TransaksiController::class);

    Route::get('/penyewa/{id}/history', [PenyewaController::class, 'historyTransaksi'])->name('penyewa.history');
    Route::post('/transaksi/{id}/pelunasan', [TransaksiController::class, 'bayarPelunasan'])->name('transaksi.pelunasan');

    Route::fallback(function () {
        return redirect()->route('admin.dashboard');
    });
});

// ==========================================
// 3. RUTE AUTH (Login/Logout/Register)
// ==========================================
// Pastikan file ini ada di folder routes/auth.php
require __DIR__.'/auth.php';