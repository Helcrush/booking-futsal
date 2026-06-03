@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Keanggotaan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Pendaftaran Member Baru</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama Form Pendaftaran --}}
@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="font-bold text-slate-800 text-lg">Form Keanggotaan Baru</h3>
            <p class="text-slate-500 text-sm mt-0.5">Pilih data penyewa atau tim reguler untuk dinaikkan statusnya menjadi member aktif arena.</p>
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

        <form action="/member" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Pilih Penyewa / Tim</label>
                <select name="penyewa_id" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    <option value="">-- Pilih Penyewa --</option>
                    @foreach($penyewa as $p)
                        <option value="{{ $p->id }}" {{ old('penyewa_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_tim }} (PJ: {{ $p->nama_penyewa }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Kode Member (Kartu)</label>
                <input type="text" name="text" value="{{ old('kode_member', 'MBR-'.rand(1000, 9999)) }}" 
                       class="w-full p-3 border border-slate-200 rounded-xl bg-slate-50 font-mono font-bold text-blue-600 text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                <p class="text-slate-400 text-xs mt-1.5">*Kode di atas dibuat otomatis oleh sistem, Anda tetap bisa mengubahnya manual jika diperlukan.</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Tanggal Mulai Aktif</label>
                    <input type="date" name="tanggal_join" value="{{ old('tanggal_join', date('Y-m-d')) }}" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Tanggal Kadaluarsa</label>
                    <input type="date" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa', date('Y-m-d', strtotime('+1 year'))) }}" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-slate-700 text-sm font-bold mb-2">Status Awal Keanggotaan</label>
                <select name="status_member" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    <option value="aktif" {{ old('status_member') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status_member') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div class="flex justify-end items-center gap-3 border-t border-slate-100 pt-4">
                <a href="/member" class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition cursor-pointer">
                    Aktifkan Member
                </button>
            </div>
        </form>
    </div>
@endsection