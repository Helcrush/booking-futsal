<header class="bg-white shadow-sm px-4 lg:px-8 py-4 flex justify-between items-center border-b border-slate-200 shrink-0 z-10">

    <div class="flex items-center gap-4">

        <!-- Tombol Sidebar Mobile -->
        <button id="toggleSidebar"
            class="lg:hidden p-2 rounded-lg hover:bg-slate-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6 text-slate-700"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        @yield('header')

    </div>

    <div class="flex items-center gap-4">

        <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-emerald-50 border border-emerald-200 rounded-full">
            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
            <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">
                Kasir Aktif
            </span>
        </div>

        <div class="h-8 w-8 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500 border border-slate-300">
            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
        </div>

    </div>

</header>