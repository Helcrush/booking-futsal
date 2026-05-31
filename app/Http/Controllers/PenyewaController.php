<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /**
     * Menampilkan semua daftar penyewa.
     */
    public function index()
    {
        $penyewa = Penyewa::all();
        
        return view('penyewa.index', compact('penyewa'));
    }

    /**
     * Menampilkan form untuk menambah penyewa baru.
     */
    public function create()
    {
        return view('penyewa.create');
    }

    /**
     * Menyimpan data penyewa baru ke database.
     * Sesuai dengan properti $fillable di model Penyewa Anda.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'no_hp'  => 'required|string|max:20',
            'email'  => 'required|email|max:255|unique:penyewa,email',
            'alamat' => 'nullable|string',
        ]);

        // Mass assignment aman berdasarkan properti fillable model
        Penyewa::create([
            'nama'   => $request->nama,
            'no_hp'  => $request->no_hp,
            'email'  => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect('/penyewa')->with('success', 'Data penyewa baru berhasil disimpan!');
    }

    /**
     * Menampilkan detail dan history transaksi milik penyewa tersebut.
     * Memanfaatkan relasi 'transaksi' dari model Penyewa Anda.
     */
    public function show(string $id)
    {
        // Mengambil penyewa sekaligus history transaksinya menggunakan Eager Loading
        $penyewa = Penyewa::with('transaksi')->findOrFail($id);
        
        return view('penyewa.history', compact('penyewa'));
    }

    /**
     * Menampilkan form edit untuk penyewa tertentu.
     */
    public function edit(string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        
        return view('penyewa.edit', compact('penyewa'));
    }

    /**
     * Memperbarui data penyewa di database.
     */
    public function update(Request $request, string $id)
    {
        $penyewa = Penyewa::findOrFail($id);

        $request->validate([
            'nama'   => 'required|string|max:255',
            'no_hp'  => 'required|string|max:20',
            'email'  => 'required|email|max:255|unique:penyewa,email,' . $penyewa->id,
            'alamat' => 'nullable|string',
        ]);

        $penyewa->update([
            'nama'   => $request->nama,
            'no_hp'  => $request->no_hp,
            'email'  => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect('/penyewa')->with('success', 'Data penyewa berhasil diperbarui!');
    }

    /**
     * Menghapus data penyewa dari sistem.
     */
    public function destroy(string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        $penyewa->delete();

        return redirect('/penyewa')->with('success', 'Data penyewa berhasil dihapus dari sistem!');
    }
}