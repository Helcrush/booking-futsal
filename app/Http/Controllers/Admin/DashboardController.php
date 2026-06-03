<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Member;
use App\Models\Penyewa;
use App\Models\Transaksi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan Halaman Utama Dashboard Admin
     */
    public function index(): View
    {
        // Mengambil hitungan data sesuai struktur migrasi terbaru Anda
        $totalLapangan = Lapangan::count();
        $totalMember   = Member::count();
        $totalPenyewa  = Penyewa::count();
        
        // 🌟 Disesuaikan dengan enum 'belum_bayar' dari file migrasi transaksi Anda
        $transaksiBaru = Transaksi::where('status_pembayaran', 'belum_bayar')->count(); 

        return view('admin.dashboard', compact('totalLapangan', 'totalMember', 'totalPenyewa', 'transaksiBaru'));
    }
}