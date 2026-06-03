@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Pelanggan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Registrasi Penyewa Baru</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama Form Tambah --}}
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">

        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="font-bold text-slate-800 text-lg">Form Pelanggan Baru</h3>
            <p class="text-slate-500 text-sm mt-0.5">Masukkan identitas lengkap pelanggan atau penanggung jawab tim baru.</p>
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

        <form action="/penyewa" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Nama Penyewa / Tim</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    placeholder="Contoh: Budi Santoso / FC Barcelona"
                    class="w-full p-3 border rounded-xl text-sm focus:outline-none transition {{ $errors->has('nama') ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-500/10' : 'border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">No. WhatsApp / HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567xxx"
                    class="w-full p-3 border rounded-xl text-sm font-mono focus:outline-none transition {{ $errors->has('no_hp') ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-500/10' : 'border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: penyewa@email.com"
                    class="w-full p-3 border rounded-xl text-sm focus:outline-none transition {{ $errors->has('email') ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-500/10' : 'border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
            </div>

            <div class="mb-6">
                <label class="block text-slate-700 text-sm font-bold mb-2">Alamat / Keterangan (Opsional)</label>
                <textarea name="alamat" rows="3" placeholder="Tulis alamat atau catatan khusus pelanggan jika ada..."
                    class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">{{ old('alamat') }}</textarea>
            </div>

            <div class="flex justify-end items-center gap-3 border-t border-slate-100 pt-4">
                <a href="/penyewa"
                    class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition cursor-pointer">
                    Simpan Penyewa
                </button>
            </div>
        </form>
    </div>
@endsection
