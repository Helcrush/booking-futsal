@extends('layouts.app')


@section('header')
    <div>
        <h1 class="text-xs text-slate-400 font-semibold uppercase tracking-wider">System Admin</h1>
        <p class="text-xl font-black text-slate-800 tracking-tight">Dashboard Utama Kasir</p>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Transaksi Pending</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $transaksiBaru }}</h3>
            </div>
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl font-bold">📝</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Penyewa</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalPenyewa }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold">👥</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Member Aktif</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalMember }}</h3>
            </div>
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl font-bold">💳</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/60 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jumlah Lapangan</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalLapangan }}</h3>
            </div>
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-xl font-bold">🏟️</div>
        </div>

    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
        <h3 class="font-bold text-slate-800 text-lg mb-4">Aksi Cepat Kasir</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="/transaksi/create" class="flex items-center gap-4 p-4 bg-slate-50 hover:bg-blue-50/50 rounded-xl border border-slate-200 hover:border-blue-300 transition group">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center text-xl shadow-md group-hover:scale-105 transition-transform">➕</div>
                <div>
                    <h4 class="font-bold text-sm text-slate-800">Input Booking Baru</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Catat jadwal pesanan offline/lewat kasir</p>
                </div>
            </a>
            <a href="/member/create" class="flex items-center gap-4 p-4 bg-slate-50 hover:bg-emerald-50/50 rounded-xl border border-slate-200 hover:border-emerald-300 transition group">
                <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center text-xl shadow-md group-hover:scale-105 transition-transform">💳</div>
                <div>
                    <h4 class="font-bold text-sm text-slate-800">Daftarkan Member Baru</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Buat status langganan keanggotaan baru tim</p>
                </div>
            </a>
        </div>
    </div>
@endsection