<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Menampilkan halaman daftar semua jadwal lapangan.
     * Memanfaatkan eager loading relasi 'lapangan' dari model Jadwal.
     */
    public function index()
    {
        $jadwal = Jadwal::with('lapangan')->get();

        // Mengarah ke resources/views/jadwal/index.blade.php
        return view('jadwal.index', compact('jadwal'));
    }

    /**
     * Menampilkan form untuk membuat slot jadwal baru.
     * Membutuhkan data Lapangan untuk looping tag <option> di HTML.
     */
    public function create()
    {
        $lapangan = Lapangan::all();

        // Mengarah ke resources/views/jadwal/create.blade.php
        return view('jadwal.create', compact('lapangan'));
    }

    /**
     * Menyimpan slot jadwal baru ke database.
     * Memanfaatkan properti $fillable pada model Jadwal.
     */
    public function store(Request $request)
    {
        // Validasi disesuaikan dengan aturan field model Anda
        $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status'      => 'required|in:tersedia,dipesan',
        ]);

        // Menggunakan Mass Assignment aman sesuai properti $fillable di model
        Jadwal::create([
            'lapangan_id' => $request->lapangan_id,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status'      => $request->status,
        ]);

        return redirect('/jadwal')->with('success', 'Slot jadwal baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail dari satu slot jadwal (Opsional jika ingin dipakai).
     */
    public function show(string $id)
    {
        $jadwal = Jadwal::with('lapangan')->findOrFail($id);

        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Menampilkan form edit untuk slot jadwal tertentu.
     */
    public function edit(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $lapangan = Lapangan::all(); // Diperlukan agar kasir bisa mengubah relasi lapangan jika salah input

        // Mengarah ke resources/views/jadwal/edit.blade.php
        return view('jadwal.edit', compact('jadwal', 'lapangan'));
    }

    /**
     * Memperbarui data slot jadwal di database.
     */
    public function update(Request $request, string $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status'      => 'required|in:tersedia,dipesan',
        ]);

        // Eksekusi pembaruan data lewat instance model
        $jadwal->update([
            'lapangan_id' => $request->lapangan_id,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status'      => $request->status,
        ]);

        return redirect('/jadwal')->with('success', 'Data slot jadwal berhasil diperbarui!');
    }

    /**
     * Menghapus slot jadwal dari database.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        
        // Hapus via Eloquent
        $jadwal->delete();

        return redirect('/lapangan')->with('success', 'Slot jadwal berhasil dihapus dari sistem!');
    }

    /**
     * Fitur Tambahan: Menampilkan jadwal yang MASIH TERSEDIA saja.
     * Menggunakan filter Query Builder Eloquent Model.
     */
    public function jadwalTersedia()
    {
        // Menyaring data berdasarkan status 'tersedia' pada tabel jadwal
        $jadwal = Jadwal::with('lapangan')
            ->where('status', 'tersedia')
            ->get();

        // Menggunakan view index yang sama demi menghemat file, namun datanya sudah terfilter
        return view('jadwal.index', compact('jadwal'));
    }
}