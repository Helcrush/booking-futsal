@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Transaksi Lapangan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Manajemen Booking</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama Tabel Monitoring Transaksi --}}
@section('content')
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Agenda Sewa Lapangan</h3>
                <p class="text-slate-500 text-sm mt-0.5">Pantau ketat jadwal pemakaian slot lapangan futsal serta validasi status pelunasan nota.</p>
            </div>
            <a href="/transaksi/create" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition">
                + Buat Booking Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-4 text-sm flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-slate-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 uppercase text-xs font-bold tracking-wider border-b border-slate-100">
                        <th class="p-4">Penyewa</th>
                        <th class="p-4">Lapangan</th>
                        <th class="p-4">Jadwal Main</th>
                        <th class="p-4">Durasi</th>
                        <th class="p-4">Total Biaya</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 text-sm divide-y divide-slate-100">
                    @forelse($transaksi as $t)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            
                            <td class="p-4 font-bold text-slate-800">
                                {{ $t->penyewa->nama ?? 'Umum / Terhapus' }}
                            </td>
                            
                            <td class="p-4">
                                <span class="bg-blue-50 text-blue-700 border border-blue-100 text-xs px-2.5 py-1 rounded-lg font-semibold tracking-wide">
                                    {{ $t->lapangan->nama_lapangan ?? 'Lapangan' }}
                                </span>
                            </td>
                            
                            <td class="p-4">
                                <div class="font-semibold text-slate-700">{{ date('d M Y', strtotime($t->tanggal_main)) }}</div>
                                <div class="text-xs text-slate-400 font-mono mt-0.5">{{ date('H:i', strtotime($t->jam_mulai)) }} - {{ date('H:i', strtotime($t->jam_selesai)) }} WIB</div>
                            </td>
                            
                            <td class="p-4 font-mono font-medium text-slate-600">
                                {{ $t->durasi_jam }} Jam
                            </td>
                            
                            <td class="p-4">
                                <div class="font-bold text-slate-800">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</div>
                                @if($t->status_pembayaran === 'dp')
                                    <div class="text-[11px] text-amber-600 font-medium mt-0.5">DP: Rp {{ number_format($t->dp_dibayar, 0, ',', '.') }}</div>
                                @endif
                            </td>
                            
                            <td class="p-4 text-center">
                                @if($t->status_pembayaran === 'lunas')
                                    <span class="inline-block bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] px-2.5 py-1 rounded-full font-bold uppercase tracking-wider shadow-sm">
                                        Lunas
                                    </span>
                                @elseif($t->status_pembayaran === 'dp')
                                    <span class="inline-block bg-amber-50 text-amber-700 border border-amber-200 text-[11px] px-2.5 py-1 rounded-full font-bold uppercase tracking-wider shadow-sm">
                                        Uang Muka (DP)
                                    </span>
                                @else
                                    <span class="inline-block bg-rose-50 text-rose-700 border border-rose-200 text-[11px] px-2.5 py-1 rounded-full font-bold uppercase tracking-wider shadow-sm">
                                        Belum Bayar
                                    </span>
                                @endif
                            </td>
                            
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="/transaksi/{{ $t->id }}/edit" class="bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Edit / Bayar
                                    </a>
                                    <form action="/transaksi/{{ $t->id }}" method="POST" onsubmit="return confirm('Batalkan booking jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition cursor-pointer">
                                            Batal
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400 font-medium">
                                <span class="block text-2xl mb-1">📅</span> Belum ada agenda booking lapangan untuk saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection