@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Keanggotaan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Perpanjang Masa Aktif</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama Form Edit --}}
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="font-bold text-slate-800 text-lg">Perbarui Status & Durasi</h3>
            <p class="text-slate-500 text-sm mt-0.5">
                Mengedit durasi masa aktif kartu member untuk Tim: 
                <span class="font-bold text-slate-700">{{ $member->penyewa->nama_tim ?? $member->penyewa->nama_penyewa }}</span>
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm">
                <div class="font-semibold mb-1">⚠️ Mohon periksa kembali inputan Anda:</div>
                <ul class="list-disc list-inside space-y-0.5 text-xs text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/member/{{ $member->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="penyewa_id" value="{{ $member->penyewa_id }}">

            <div class="mb-4">
                <label class="block text-slate-400 text-sm font-semibold mb-2">Kode Member (Tidak Dapat Diubah)</label>
                <input type="text" name="kode_member" value="{{ $member->kode_member }}" readonly 
                       class="w-full p-3 border border-slate-200 rounded-xl bg-slate-50 font-mono font-bold text-slate-400 cursor-not-allowed text-sm">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Tanggal Join</label>
                    <input type="date" name="tanggal_join" value="{{ old('tanggal_join', $member->tanggal_join) }}" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Tanggal Kadaluarsa Baru</label>
                    <input type="date" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa', $member->tanggal_kadaluarsa) }}" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-slate-700 text-sm font-bold mb-2">Status Keanggotaan</label>
                <select name="status_member" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    <option value="aktif" {{ old('status_member', $member->status_member) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status_member', $member->status_member) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div class="flex justify-end items-center gap-3 border-t border-slate-100 pt-4">
                <a href="/member" class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-emerald-600/20 transition cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection