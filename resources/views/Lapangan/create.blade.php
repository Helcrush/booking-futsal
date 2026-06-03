@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Lapangan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Registrasi Lapangan Baru</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama Form Tambah --}}
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">

        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="font-bold text-slate-800 text-lg">Form Lapangan Baru</h3>
            <p class="text-slate-500 text-sm mt-0.5">Silakan isi formulir di bawah ini secara lengkap untuk mendaftarkan
                fasilitas arena baru.</p>
        </div>

        <form action="/lapangan" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Nama Lapangan</label>
                <input type="text" name="nama_lapangan" value="{{ old('nama_lapangan') }}"
                    placeholder="Contoh: Lapangan A (Sintetis)"
                    class="w-full p-3 border rounded-xl text-sm focus:outline-none transition {{ $errors->has('nama_lapangan') ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-500/10' : 'border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
                @error('nama_lapangan')
                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Jenis Rumput / Lantai</label>
                <input type="text" name="jenis_rumput" value="{{ old('jenis_rumput') }}"
                    placeholder="Contoh: Rumput Sintetis / Vinyl / Matras"
                    class="w-full p-3 border rounded-xl text-sm focus:outline-none transition {{ $errors->has('jenis_rumput') ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-500/10' : 'border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
                @error('jenis_rumput')
                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Harga Sewa Per Jam (Rp)</label>
                <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam') }}" placeholder="Contoh: 150000"
                    class="w-full p-3 border rounded-xl text-sm font-mono focus:outline-none transition {{ $errors->has('harga_per_jam') ? 'border-red-400 focus:border-red-500 focus:ring-4 focus:ring-red-500/10' : 'border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10' }}">
                @error('harga_per_jam')
                    <p class="text-red-600 text-xs mt-1.5 flex items-center gap-1"><span>⚠️</span> {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-slate-700 text-sm font-bold mb-2">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="3" placeholder="Fasilitas tambahan lapangan..."
                    class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex justify-end items-center gap-3 border-t border-slate-100 pt-4">
                <a href="/lapangan"
                    class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition cursor-pointer">
                    Simpan Lapangan
                </button>
            </div>
        </form>
    </div>
@endsection
