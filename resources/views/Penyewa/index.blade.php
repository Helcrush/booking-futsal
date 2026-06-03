@extends('layouts.app')

{{-- Bagian Judul Topbar --}}
@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Manajemen Pelanggan</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Daftar Penyewa & Tim</p>
    </div>
@endsection

{{-- Konten Utama --}}
@section('content')
    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="font-bold text-slate-800 text-lg">Basis Data Pelanggan</h3>
                <p class="text-slate-500 text-sm mt-0.5">Kelola data identitas, email aktif, dan kontak WhatsApp penanggung jawab tim.</p>
            </div>
            <a href="/penyewa/create" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-blue-600/20 transition">
                + Tambah Penyewa Baru
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
                        <th class="p-4">Nama Penyewa</th>
                        <th class="p-4">No. HP / WhatsApp</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Alamat / Catatan</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-slate-600 text-sm divide-y divide-slate-100">
                    @forelse($penyewa as $p)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-bold text-slate-800">{{ $p->nama }}</td>
                            <td class="p-4 font-mono font-medium text-blue-600">{{ $p->no_hp }}</td>
                            <td class="p-4 text-slate-500">{{ $p->email }}</td>
                            <td class="p-4 text-slate-400 max-w-xs truncate">{{ $p->alamat ?? '-' }}</td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="/penyewa/{{ $p->id }}" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 px-2.5 py-1.5 rounded-lg text-xs font-semibold transition flex items-center gap-1">
                                        <span>📜</span> History
                                    </a>
                                    <a href="/penyewa/{{ $p->id }}/edit" class="bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 px-2.5 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Edit
                                    </a>
                                    <form action="/penyewa/{{ $p->id }}" method="POST" onsubmit="return confirm('Hapus data penyewa ini? Semua data terkait mungkin akan terpengaruh.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-2.5 py-1.5 rounded-lg text-xs font-semibold transition cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400 font-medium">
                                <span class="block text-2xl mb-1">👥</span> Belum ada data pelanggan yang terdaftar di database.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection