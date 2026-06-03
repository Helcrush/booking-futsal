@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Lapangan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Daftar Arena Futsal</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama --}}
@section('content')
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Data Lapangan</h3>
                <p class="text-slate-500 text-sm mt-0.5">Kelola informasi fasilitas, jenis rumput, dan tarif sewa per jam.</p>
            </div>
            <a href="/lapangan/create" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition">
                + Tambah Lapangan
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
                        <th class="p-4">Nama Lapangan</th>
                        <th class="p-4">Jenis Rumput</th>
                        <th class="p-4">Harga / Jam</th>
                        <th class="p-4">Deskripsi</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 text-sm divide-y divide-slate-100">
                    @forelse($lapangan as $lap)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-bold text-slate-800">{{ $lap->nama_lapangan }}</td>
                            <td class="p-4">
                                <span class="bg-slate-100 text-slate-700 text-xs px-2.5 py-1 rounded-md font-medium border border-slate-200/60">
                                    {{ $lap->jenis_rumput }}
                                </span>
                            </td>
                            <td class="p-4 text-emerald-600 font-extrabold font-mono text-base">
                                Rp {{ number_format($lap->harga_per_jam, 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-slate-400 max-w-xs truncate">{{ $lap->deskripsi ?? '-' }}</td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="/lapangan/{{ $lap->id }}/edit" class="bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Edit
                                    </a>
                                    <form action="/lapangan/{{ $lap->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lapangan ini?')">
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
                                <span class="block text-2xl mb-1">🏟️</span> Belum ada data lapangan yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection