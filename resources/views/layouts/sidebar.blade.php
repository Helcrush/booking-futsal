<aside id="sidebar"
    class="fixed lg:relative
           top-0 left-0
           z-50 lg:z-auto
           w-64
           h-screen
           bg-slate-900
           text-slate-300
           flex flex-col
           shrink-0
           transform
           -translate-x-full
           lg:translate-x-0
           transition-transform
           duration-300">

    <div class="p-6 border-b border-slate-800 flex justify-between items-center">

        <h1 class="text-white font-black text-xl tracking-tight">
            ARENA FUTSAL
        </h1>

        <!-- Tombol Close Mobile -->
        <button id="toggleSidebar"
            class="lg:hidden text-slate-400 hover:text-white text-xl">
            ✕
        </button>

    </div>

    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/dashboard') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <span>📊</span>
            Dashboard
        </a>

        <a href="{{ route('transaksi.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/transaksi*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <span>⚽</span>
            Transaksi Booking
        </a>

        <div class="pt-4 pb-2 text-xs font-bold uppercase text-slate-500 pl-4 tracking-wider">
            Pelanggan
        </div>

        <a href="{{ route('penyewa.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/penyewa*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <span>👥</span>
            Data Penyewa
        </a>

        <a href="{{ route('member.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/member*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <span>⭐</span>
            Keanggotaan (Member)
        </a>

        <div class="pt-4 pb-2 text-xs font-bold uppercase text-slate-500 pl-4 tracking-wider">
            Operasional
        </div>

        <a href="{{ route('lapangan.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/lapangan*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <span>🏟️</span>
            Data Lapangan
        </a>

        <a href="{{ route('jadwal.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('admin/jadwal*') ? 'bg-slate-800 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <span>📅</span>
            Jadwal Operasional
        </a>

    </nav>

    <div class="p-4 border-t border-slate-800">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-rose-400 hover:bg-rose-900/20 transition">
                <span>🚪</span>
                Logout
            </button>

        </form>

    </div>

</aside>