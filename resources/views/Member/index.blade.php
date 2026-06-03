@extends('layouts.app')

{{-- 1. Mengisi Bagian Header / Judul Halaman di Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Keanggotaan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Daftar Member Resmi</p>
    </div>
@endsection

{{-- 2. Mengisi Bagian Konten Utama --}}
@section('content')
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Data Member</h3>
                <p class="text-slate-500 text-sm mt-0.5">Kelola data penyewa dan tim yang memiliki hak akses langganan tetap.</p>
            </div>
            <a href="/member/create" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition">
                + Daftarkan Member Baru
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
                        <th class="p-4">Kode Member</th>
                        <th class="p-4">Nama Tim / Penyewa</th>
                        <th class="p-4">Tanggal Join</th>
                        <th class="p-4">Masa Berlaku</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 text-sm divide-y divide-slate-100">
                    @forelse($member as $m)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-mono font-bold text-blue-600 tracking-wide text-sm">
                                {{ $m->kode_member }}
                            </td>
                            
                            <td class="p-4 font-bold text-slate-800">
                                {{ $m->penyewa->nama_tim ?? $m->penyewa->nama_penyewa }}
                            </td>
                            
                            <td class="p-4 text-slate-500">
                                {{ date('d M Y', strtotime($m->tanggal_join)) }}
                            </td>
                            
                            <td class="p-4 font-semibold text-amber-700 bg-amber-50/40">
                                {{ date('d M Y', strtotime($m->tanggal_kadaluarsa)) }}
                            </td>
                            
                            <td class="p-4 text-center">
                                @if($m->status_member === 'aktif')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-xs px-2.5 py-1 rounded-full font-bold uppercase border border-emerald-200/50">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-700 text-xs px-2.5 py-1 rounded-full font-bold uppercase border border-rose-200/50">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="/member/{{ $m->id }}/edit" class="bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Perpanjang / Edit
                                    </a>
                                    <form action="/member/{{ $m->id }}" method="POST" onsubmit="return confirm('Hapus status keanggotaan member ini?')">
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
                            <td colspan="6" class="p-8 text-center text-slate-400 font-medium">
                                <span class="block text-2xl mb-1">💳</span> Belum ada penyewa yang terdaftar sebagai member.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection