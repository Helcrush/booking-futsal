<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Penyewa;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Menampilkan daftar semua member.
     * Menggunakan eager loading 'penyewa' sesuai fungsi relasi di model Anda.
     */
    public function index()
    {
        $member = Member::with('penyewa')->get();
        
        return view('member.index', compact('member'));
    }

    /**
     * Menampilkan form pendaftaran member baru.
     * Mengambil semua data penyewa untuk opsi pilihan (dropdown).
     */
    public function create()
    {
        $penyewa = Penyewa::all();
        
        return view('member.create', compact('penyewa'));
    }

    /**
     * Menyimpan data member baru ke database.
     * Sesuai dengan properti $fillable di model Member Anda.
     */
    public function store(Request $request)
    {
        // Validasi data inputan kasir/admin
        $request->validate([
            'penyewa_id'         => 'required|exists:penyewa,id|unique:member,penyewa_id', // 1 penyewa hanya boleh punya 1 kartu member
            'kode_member'        => 'required|string|max:255|unique:member,kode_member',
            'tanggal_join'       => 'required|date',
            'tanggal_kadaluarsa' => 'required|date|after:tanggal_join',
            'status_member'      => 'required|in:aktif,nonaktif',
        ], [
            'penyewa_id.unique'  => 'Penyewa/Tim ini sudah terdaftar sebagai member!',
            'kode_member.unique' => 'Kode member sudah digunakan oleh orang lain.'
        ]);

        // Menyimpan data menggunakan Mass Assignment model Member
        Member::create([
            'penyewa_id'         => $request->penyewa_id,
            'kode_member'        => $request->kode_member,
            'tanggal_join'       => $request->tanggal_join,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'status_member'      => $request->status_member,
        ]);

        return redirect('/member')->with('success', 'Member baru berhasil diaktifkan!');
    }

    /**
     * Menampilkan detail member (jika diperlukan).
     */
    public function show(string $id)
    {
        $member = Member::with('penyewa')->findOrFail($id);
        
        return view('member.show', compact('member'));
    }

    /**
     * Menampilkan form edit/perpanjang status member.
     */
    public function edit(string $id)
    {
        $member = Member::with('penyewa')->findOrFail($id);
        $penyewa = Penyewa::all(); // Diperlukan jika admin ingin mengubah relasi penyewa

        return view('member.edit', compact('member', 'penyewa'));
    }

    /**
     * Memperbarui data member di database.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'penyewa_id'         => 'required|exists:penyewa,id|unique:member,penyewa_id,' . $member->id,
            'kode_member'        => 'required|string|max:255|unique:member,kode_member,' . $member->id,
            'tanggal_join'       => 'required|date',
            'tanggal_kadaluarsa' => 'required|date|after:tanggal_join',
            'status_member'      => 'required|in:aktif,nonaktif',
        ]);

        // Melakukan update data melalui instance model Member
        $member->update([
            'penyewa_id'         => $request->penyewa_id,
            'kode_member'        => $request->kode_member,
            'tanggal_join'       => $request->tanggal_join,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'status_member'      => $request->status_member,
        ]);

        return redirect('/member')->with('success', 'Data member berhasil diperbarui!');
    }

    /**
     * Menghapus status member (Penyewa kembali menjadi pelanggan biasa).
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect('/member')->with('success', 'Status keanggotaan member berhasil dihapus!');
    }
}