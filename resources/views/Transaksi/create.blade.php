@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Transaksi Lapangan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Buat Booking Baru</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama Form Transaksi --}}
@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="mb-6 border-b border-slate-100 pb-4">
            <h3 class="font-bold text-slate-800 text-lg">Form Penyewaan Lapangan</h3>
            <p class="text-slate-500 text-sm mt-0.5">Sistem otomatis mencocokkan ketersediaan jadwal serta menghitung akumulasi biaya sewa.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm">
                <div class="font-semibold mb-1">⚠️ Gagal Menyimpan: Silakan periksa kolom berikut</div>
                <ul class="list-disc list-inside space-y-0.5 text-xs text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/transaksi" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Pilih Penyewa / Club</label>
                    <select name="penyewa_id" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($penyewa as $p)
                            <option value="{{ $p->id }}" {{ old('penyewa_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Pilih Lapangan</label>
                    <select name="lapangan_id" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        <option value="">-- Pilih Jenis Lapangan --</option>
                        @foreach($lapangan as $l)
                            <option value="{{ $l->id }}" {{ old('lapangan_id') == $l->id ? 'selected' : '' }}>
                                {{ $l->nama_lapangan }} (Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }}/jam)
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-slate-700 text-sm font-bold mb-2">Tanggal Main</label>
                <input type="date" name="tanggal_main" value="{{ old('tanggal_main', date('Y-m-d')) }}" 
                       class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" 
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">DP Dibayar (Rp)</label>
                    <input type="number" name="dp_dibayar" value="{{ old('dp_dibayar', 0) }}" min="0" 
                           placeholder="0"
                           class="w-full p-3 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Status Bayar</label>
                    <select name="status_pembayaran" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        <option value="belum_bayar" {{ old('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="dp" {{ old('status_pembayaran') == 'dp' ? 'selected' : '' }}>DP (Down Payment)</option>
                        <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <div>
                    <label class="block text-slate-700 text-sm font-bold mb-2">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="w-full p-3 border border-slate-200 rounded-xl bg-white text-sm text-slate-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash (Tunai)</option>
                        <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end items-center gap-3 border-t border-slate-100 pt-4">
                <a href="/transaksi" class="px-4 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition cursor-pointer">
                    Simpan Booking
                </button>
            </div>
        </form>
    </div>
@endsection