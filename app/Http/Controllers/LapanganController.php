<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    /**
     * Menampilkan halaman utama (Daftar Lapangan)
     * Menggunakan model Lapangan untuk mengambil semua data.
     */
    public function index()
    {
        $lapangan = Lapangan::all();
        
        // Membuka file resources/views/lapangan/index.blade.php
        return view('lapangan.index', compact('lapangan'));
    }

    /**
     * Menampilkan form untuk membuat lapangan baru
     */
    public function create()
    {
        // Membuka file resources/views/lapangan/create.blade.php
        return view('lapangan.create');
    }

    /**
     * Menyimpan data lapangan baru ke database
     * Memanfaatkan properti $fillable pada model Lapangan untuk keamanan Mass Assignment.
     */
    public function store(Request $request)
    {
        // Validasi data inputan sesuai kolom yang ada di model
        $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'jenis_rumput'  => 'required|string|max:255',
            'harga_per_jam' => 'required|integer|min:0',
            'deskripsi'     => 'nullable|string',
        ]);

        // Menyimpan data menggunakan method create bawaan Eloquent Model
        Lapangan::create([
            'nama_lapangan' => $request->nama_lapangan,
            'jenis_rumput'  => $request->jenis_rumput,
            'harga_per_jam' => $request->harga_per_jam,
            'deskripsi'     => $request->deskripsi,
        ]);

        // Setelah berhasil, kembalikan ke halaman index dengan pesan sukses
        return redirect('/lapangan')->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail lapangan tertentu beserta relasi jadwal atau transaksinya jika diperlukan.
     */
    public function show(string $id)
    {
        // Mencari lapangan berdasarkan ID, jika tidak ada langsung memunculkan error 404
        // Menambahkan method dengan relasi 'jadwal' dan 'transaksi' sesuai yang ada di model Anda
        $lapangan = Lapangan::with(['jadwal', 'transaksi'])->findOrFail($id);

        return view('lapangan.show', compact('lapangan'));
    }

    /**
     * Menampilkan form edit untuk lapangan tertentu
     */
    public function edit(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        // Membuka file resources/views/lapangan/edit.blade.php
        return view('lapangan.edit', compact('lapangan'));
    }

    /**
     * Memperbarui data lapangan di database
     */
    public function update(Request $request, string $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'jenis_rumput'  => 'required|string|max:255',
            'harga_per_jam' => 'required|integer|min:0',
            'deskripsi'     => 'nullable|string',
        ]);

        // Mengandalkan model Lapangan untuk melakukan update data
        $lapangan->update([
            'nama_lapangan' => $request->nama_lapangan,
            'jenis_rumput'  => $request->jenis_rumput,
            'harga_per_jam' => $request->harga_per_jam,
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect('/lapangan')->with('success', 'Data lapangan berhasil diperbarui!');
    }

    /**
     * Menghapus data lapangan dari database
     */
    public function destroy(string $id)
    {
        $lapangan = Lapangan::findOrFail($id);
        
        // Menghapus data melalui model
        $lapangan->delete();

        return redirect('/lapangan')->with('success', 'Lapangan berhasil dihapus dari sistem!');
    }
}