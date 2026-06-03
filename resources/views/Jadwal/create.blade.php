@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Jadwal</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Tambah Slot Baru</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama Form --}}
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="font-bold text-slate-800 text-lg">Form Tambah Slot Jadwal</h3>
            <p class="text-slate-500 text-sm mt-0.5">Gunakan form ini untuk mendaftarkan jam operasional sewa baru pada lapangan.</p>
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

        <form action="/jadwal" method="POST">
            @csrf
            
            <div class="mb-5">
                <label class="block text-slate-700 text-sm font-bold mb-2">Pilih Lapangan Futsal</label>
                <select name="lapangan_id" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    <option value="">-- Pilih Lapangan --</option>
                    @foreach($lapangan as $lap)
                        <option value="{{ $lap->id }}" {{ old('lapangan_id') == $lap->id ? 'selected' : '' }}>
                            {{ $lap->nama_lapangan }} (Tarif: Rp {{ number_format($lap->harga_per_jam, 0, ',', '.') }}/jam)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Jam Mulai Main</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Jam Selesai Main</label>
                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>
            </div>

            <div class="mb-6 bg-slate-50 p-4 rounded-xl border border-slate-100">
                <label class="block text-slate-800 text-sm font-bold mb-2">Status Awal Slot</label>
                <div class="flex gap-6 mt-1">
                    <label class="inline-flex items-center cursor-pointer group">
                        <input type="radio" name="status" value="tersedia" checked class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500/20">
                        <span class="ml-2 text-slate-700 text-sm font-medium group-hover:text-slate-900 transition-colors">Tersedia (Kosong)</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer group">
                        <input type="radio" name="status" value="dipesan" class="w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500/20">
                        <span class="ml-2 text-slate-700 text-sm font-medium group-hover:text-slate-900 transition-colors">Dipesan (Booked)</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end items-center gap-3 border-t border-slate-100 pt-4">
                <a href="/jadwal" class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition cursor-pointer">
                    Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
@endsection