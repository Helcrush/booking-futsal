<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua rute di bawah ini mengarah ke tampilan View Blade (HTML)
| dan diproses secara berurutan dari atas ke bawah.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// 1. RUTE LAPANGAN (MANUAL)
// ==========================================
Route::get('/lapangan', [LapanganController::class, 'index']);             // 1. Tampilan tabel daftar lapangan
Route::get('/lapangan/create', [LapanganController::class, 'create']);     // 2. Form Tambah (HARUS DI ATAS {id})
Route::post('/lapangan', [LapanganController::class, 'store']);            // 3. Eksekusi Simpan Data Baru
Route::get('/lapangan/{id}', [LapanganController::class, 'show']);         // 4. Detail satu lapangan
Route::get('/lapangan/{id}/edit', [LapanganController::class, 'edit']);    // 5. Form Edit (HARUS DI ATAS {id} PUT)
Route::put('/lapangan/{id}', [LapanganController::class, 'update']);       // 6. Eksekusi Perbarui Data
Route::delete('/lapangan/{id}', [LapanganController::class, 'destroy']);   // 7. Eksekusi Hapus data


// ==========================================
// 2. RUTE JADWAL OPERASIONAL (MANUAL)
// ==========================================
Route::get('/jadwal/tersedia', [JadwalController::class, 'jadwalTersedia']); // 1. Cek slot kosong (HARUS DI ATAS {id})
Route::get('/jadwal', [JadwalController::class, 'index']);                   // 2. Tampilan daftar semua jadwal
Route::get('/jadwal/create', [JadwalController::class, 'create']);           // 3. Form Tambah Jadwal
Route::post('/jadwal', [JadwalController::class, 'store']);                  // 4. Eksekusi Simpan Jadwal
Route::get('/jadwal/{id}', [JadwalController::class, 'show']);               // 5. Detail satu jadwal
Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit']);          // 6. Form Edit Jadwal
Route::put('/jadwal/{id}', [JadwalController::class, 'update']);             // 7. Eksekusi Perbarui Jadwal
Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy']);         // 8. Eksekusi Hapus Jadwal


// ==========================================
// 3. RUTE PENYEWA / PELANGGAN (MANUAL)
// ==========================================
Route::get('/penyewa/{id}/history', [PenyewaController::class, 'historyTransaksi']); // 1. Cek history tim (HARUS DI ATAS {id})
Route::get('/penyewa', [PenyewaController::class, 'index']);                         // 2. Tampilan daftar penyewa
Route::get('/penyewa/create', [PenyewaController::class, 'create']);                 // 3. Form Tambah Penyewa
Route::post('/penyewa', [PenyewaController::class, 'store']);                        // 4. Eksekusi Simpan Penyewa
Route::get('/penyewa/{id}', [PenyewaController::class, 'show']);                     // 5. Detail profil penyewa
Route::get('/penyewa/{id}/edit', [PenyewaController::class, 'edit']);                // 6. Form Edit Profil Penyewa
Route::put('/penyewa/{id}', [PenyewaController::class, 'update']);                   // 7. Eksekusi Perbarui Penyewa
Route::delete('/penyewa/{id}', [PenyewaController::class, 'destroy']);                // 8. Eksekusi Hapus Penyewa


// ==========================================
// 4. RUTE MEMBER / KEANGGOTAAN (MANUAL)
// ==========================================
Route::get('/member', [MemberController::class, 'index']);             // 1. Tampilan daftar member
Route::get('/member/create', [MemberController::class, 'create']);     // 2. Form Daftarkan Member Baru
Route::post('/member', [MemberController::class, 'store']);            // 3. Eksekusi Daftar Member
Route::get('/member/{id}', [MemberController::class, 'show']);         // 4. Detail data member
Route::get('/member/{id}/edit', [MemberController::class, 'edit']);    // 5. Form Ubah Status/Masa Aktif
Route::put('/member/{id}', [MemberController::class, 'update']);       // 6. Eksekusi Perbarui Member
Route::delete('/member/{id}', [MemberController::class, 'destroy']);   // 7. Eksekusi Hapus Member


// ==========================================
// 5. RUTE TRANSAKSI BOOKING (MANUAL)
// ==========================================
Route::get('/transaksi', [TransaksiController::class, 'index']);                   // 1. Tampilan daftar booking
Route::get('/transaksi/create', [TransaksiController::class, 'create']);           // 2. Form transaksi booking baru
Route::post('/transaksi', [TransaksiController::class, 'store']);                  // 3. Eksekusi Proses Booking (Anti-bentrok)
Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);               // 4. Detail data transaksi
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);          // 5. Form Edit Booking
Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);             // 6. Eksekusi Perbarui Transaksi
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);         // 7. Batalkan/Cancel booking
Route::post('/transaksi/{id}/pelunasan', [TransaksiController::class, 'bayarPelunasan']); // 8. Eksekusi input pelunasan kasir