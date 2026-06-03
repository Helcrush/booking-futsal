@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Jadwal</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Operasional Lapangan</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama --}}
@section('content')
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Master Slot Jadwal</h3>
                <p class="text-slate-500 text-sm mt-0.5">Kelola slot jam operasional dan status masing-masing lapangan.</p>
            </div>
            <div class="flex gap-2 w-full sm:w-auto">
                <a href="/jadwal/tersedia" class="flex-1 sm:flex-none text-center bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2.5 rounded-xl text-sm font-semibold transition">
                    🔍 Cek Slot Kosong
                </a>
                <a href="/jadwal/create" class="flex-1 sm:flex-none text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition">
                    + Tambah Slot Jadwal
                </a>
            </div>
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
                        <th class="p-4">Nama Lapangan</th>
                        <th class="p-4">Jam Mulai</th>
                        <th class="p-4">Jam Selesai</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 text-sm divide-y divide-slate-100">
                    @forelse($jadwal as $j)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-bold text-slate-800">{{ $j->lapangan->nama_lapangan }}</td>
                            <td class="p-4 font-mono font-medium text-slate-700">{{ date('H:i', strtotime($j->jam_mulai)) }} WIB</td>
                            <td class="p-4 font-mono font-medium text-slate-700">{{ date('H:i', strtotime($j->jam_selesai)) }} WIB</td>
                            <td class="p-4 text-center">
                                @if($j->status === 'tersedia')
                                    <span class="bg-emerald-50 text-emerald-700 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider border border-emerald-100">Tersedia</span>
                                @else
                                    <span class="bg-red-50 text-red-700 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider border border-red-100">Dipesan</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="/jadwal/{{ $j->id }}/edit" class="bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Edit
                                    </a>
                                    <form action="/jadwal/{{ $j->id }}" method="POST" onsubmit="return confirm('Hapus slot jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400 font-medium">
                                <span class="block text-2xl mb-1">📅</span> Belum ada master jadwal yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection