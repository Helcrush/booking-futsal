@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Transaksi Lapangan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Edit / Pelunasan Booking</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama Form Edit --}}
@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="font-bold text-slate-800 text-lg">Ubah Rincian & Status Nota</h3>
            <p class="text-slate-500 text-sm mt-0.5">Ubah rincian jam bermain atau sesuaikan nominal serta status pembayaran pelanggan.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm">
                <div class="font-semibold mb-1">⚠️ Gagal Memperbarui: Periksa kembali data berikut</div>
                <ul class="list-disc list-inside space-y-0.5 text-xs text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/transaksi/{{ $transaksi->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Penyewa</label>
                    <select name="penyewa_id" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        @foreach($penyewa as $p)
                            <option value="{{ $p->id }}" {{ old('penyewa_id', $transaksi->penyewa_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Lapangan</label>
                    <select name="lapangan_id" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        @foreach($lapangan as $l)
                            <option value="{{ $l->id }}" {{ old('lapangan_id', $transaksi->lapangan_id) == $l->id ? 'selected' : '' }}>
                                {{ $l->nama_lapangan }} (Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }}/jam)
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Tanggal Main</label>
                <input type="date" name="tanggal_main" value="{{ old('tanggal_main', $transaksi->tanggal_main) }}" 
                       class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai', date('H:i', strtotime($transaksi->jam_mulai))) }}" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai', date('H:i', strtotime($transaksi->jam_selesai))) }}" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">DP Dibayar (Rp)</label>
                    <input type="number" name="dp_dibayar" value="{{ old