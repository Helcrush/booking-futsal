<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Penyewa;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar riwayat transaksi penyewaan lapangan.
     */
    public function index()
    {
        // Mengambil semua data transaksi beserta data penyewa dan lapangan terkait
        $transaksi = Transaksi::with(['penyewa', 'lapangan'])->latest()->get();

        return view('transaksi.index', compact('transaksi'));
    }

    /**
     * Menampilkan form pembuatan transaksi baru / booking lapangan.
     */
    public function create()
    {
        $penyewa = Penyewa::all();
        $lapangan = Lapangan::all();

        return view('transaksi.create', compact('penyewa', 'lapangan'));
    }

    /**
     * Menyimpan transaksi booking baru dengan validasi bentrok jadwal.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penyewa_id'        => 'required|exists:penyewa,id',
            'lapangan_id'       => 'required|exists:lapangan,id',
            'tanggal_main'      => 'required|date|after_or_equal:today',
            'jam_mulai'         => 'required|date_format:H:i',
            'jam_selesai'       => 'required|date_format:H:i|after:jam_mulai',
            'dp_dibayar'        => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:belum_bayar,dp,lunas',
            'metode_pembayaran' => 'required|in:cash,transfer',
        ]);

        // 1. Cek validasi jadwal bentrok (Overlap schedule checking)
        $bentrok = Transaksi::where('lapangan_id', $request->lapangan_id)
            ->where('tanggal_main', $request->tanggal_main)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_mulai', '<', $request->jam_selesai)
                      ->where('jam_selesai', '>', $request->jam_mulai);
                });
            })->exists();

        if ($bentrok) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jam_mulai' => 'Jadwal lapangan pada jam tersebut sudah dibooking oleh tim lain!']);
        }

        // 2. Hitung Otomatis Durasi Jam memakai Carbon
        $mulai = Carbon::parse($request->jam_mulai);
        $selesai = Carbon::parse($request->jam_selesai);
        $durasiJam = $mulai->diffInMinutes($selesai) / 60;

        // 3. Hitung Total Harga berdasarkan harga per jam lapangan tersebut
        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $totalHarga = $durasiJam * $lapangan->harga_per_jam; // Pastikan model Lapangan Anda punya properti harga_per_jam

        // 4. Simpan ke database
        Transaksi::create([
            'penyewa_id'        => $request->penyewa_id,
            'lapangan_id'       => $request->lapangan_id,
            'tanggal_main'      => $request->tanggal_main,
            'jam_mulai'         => $request->jam_mulai,
            'jam_selesai'       => $request->jam_selesai,
            'durasi_jam'        => $durasiJam,
            'total_harga'       => $totalHarga,
            'dp_dibayar'        => $request->dp_dibayar,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect('/transaksi')->with('success', 'Booking lapangan berhasil dibuat!');
    }

    /**
     * Menampilkan rincian/nota transaksi (Invoice).
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::with(['penyewa', 'lapangan'])->findOrFail($id);

        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Menampilkan form edit status pembayaran atau perubahan jadwal.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $penyewa = Penyewa::all();
        $lapangan = Lapangan::all();

        return view('transaksi.edit', compact('transaksi', 'penyewa', 'lapangan'));
    }

    /**
     * Memperbarui data transaksi dan hitung ulang nominal jika jam bermain berubah.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'penyewa_id'        => 'required|exists:penyewa,id',
            'lapangan_id'       => 'required|exists:lapangan,id',
            'tanggal_main'      => 'required|date',
            'jam_mulai'         => 'required|date_format:H:i',
            'jam_selesai'       => 'required|date_format:H:i|after:jam_mulai',
            'dp_dibayar'        => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:belum_bayar,dp,lunas',
            'metode_pembayaran' => 'required|in:cash,transfer',
        ]);

        // Cek bentrok jadwal (kecuali transaksi ini sendiri yang sedang di-update)
        $bentrok = Transaksi::where('id', '!=', $id)
            ->where('lapangan_id', $request->lapangan_id)
            ->where('tanggal_main', $request->tanggal_main)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('jam_mulai', '<', $request->jam_selesai)
                      ->where('jam_selesai', '>', $request->jam_mulai);
                });
            })->exists();

        if ($bentrok) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jam_mulai' => 'Perubahan gagal! Jadwal jam tersebut bentrok dengan bookingan lain.']);
        }

        // Hitung ulang durasi dan total harga
        $mulai = Carbon::parse($request->jam_mulai);
        $selesai = Carbon::parse($request->jam_selesai);
        $durasiJam = $mulai->diffInMinutes($selesai) / 60;

        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $totalHarga = $durasiJam * $lapangan->harga_per_jam;

        $transaksi->update([
            'penyewa_id'        => $request->penyewa_id,
            'lapangan_id'       => $request->lapangan_id,
            'tanggal_main'      => $request->tanggal_main,
            'jam_mulai'         => $request->jam_mulai,
            'jam_selesai'       => $request->jam_selesai,
            'durasi_jam'        => $durasiJam,
            'total_harga'       => $totalHarga,
            'dp_dibayar'        => $request->dp_dibayar,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect('/transaksi')->with('success', 'Data transaksi booking berhasil diperbarui!');
    }

    /**
     * Membatalkan / Menghapus data transaksi.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect('/transaksi')->with('success', 'Transaksi booking berhasil dihapus!');
    }
}