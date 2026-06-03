<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Dashboard Arena Futsal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-50 font-sans antialiased">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl">⚽</span>
                <span class="text-xl font-bold text-gray-800 tracking-tight">Admin<span class="text-blue-600">Futsal</span></span>
            </div>

            <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="/penyewa" class="hover:text-blue-600 transition">Data Penyewa</a>
                <a href="/member" class="hover:text-blue-600 transition">Keanggotaan Member</a>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg shadow-sm transition">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
                        Login
                    </a>
                @endauth
            </div>

            <button id="menu-btn" class="md:hidden text-gray-600 hover:text-blue-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 px-4 py-4 space-y-3 shadow-inner">
            <a href="/penyewa" class="block text-gray-600 hover:text-blue-600 font-medium py-1">Data Penyewa</a>
            <a href="/member" class="block text-gray-600 hover:text-blue-600 font-medium py-1">Keanggotaan Member</a>
            
            @auth
                <a href="{{ route('admin.dashboard') }}" class="block bg-slate-900 text-white text-center px-4 py-2 rounded-lg font-medium">Dashboard Admin</a>
            @else
                <a href="{{ route('login') }}" class="block text-gray-600 hover:text-blue-600 font-medium py-1">Login</a>
                <a href="{{ route('login') }}" class="block bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-2 rounded-lg font-medium transition">Mulai Booking</a>
            @endauth
        </div>
    </nav>

    <header class="relative bg-gradient-to-br from-gray-900 via-slate-800 to-blue-900 text-white py-16 md:py-24 px-4 sm:px-6 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span class="bg-blue-500/20 text-blue-300 text-xs font-semibold px-3 py-1.5 rounded-full uppercase tracking-wider inline-block">
                Futsal Management System v1.0
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mt-4 mb-6 leading-tight">
                Kelola Jadwal Lapangan & Member <br class="hidden md:inline">Futsal Jadi Lebih Praktis
            </h1>
            <p class="text-gray-300 text-base md:text-lg max-w-2xl mx-auto mb-8 font-light leading-relaxed">
                Sistem integrasi kasir untuk mencatat data penyewa, mengelola kartu member otomatis, hingga monitoring bentrok jadwal transaksi secara real-time.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 px-4 sm:px-0">
                <a href="/admin/transaksi/create" class="bg-blue-600 hover:bg-blue-500 text-white font-medium px-6 py-3 rounded-xl shadow-lg shadow-blue-900/30 transition-all text-center">
                    Isi Jadwal Main Baru
                </a>
                <a href="/admin/member/create" class="bg-white/10 hover:bg-white/20 text-white font-medium px-6 py-3 rounded-xl backdrop-blur transition border border-white/10 text-center">
                    Daftarkan Member
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-16">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Modul Administrasi Utama</h2>
            <p class="text-gray-500 text-sm mt-2">Pilih panel kontrol di bawah ini untuk mengelola operasional arena.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">👥</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Manajemen Penyewa</h3>
                <p class="text-gray-500 text-sm mb-4 leading-relaxed">Simpan data kontak pelanggan, nama tim, alamat email aktif, dan riwayat kunjungan main mereka.</p>
                <a href="/admin/penyewa" class="text-blue-600 font-semibold text-sm inline-flex items-center gap-1 hover:gap-2 transition-all">Buka Data Penyewa &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">💳</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Sistem Keanggotaan</h3>
                <p class="text-gray-500 text-sm mb-4 leading-relaxed">Buat kode kartu member otomatis, atur masa kadaluarsa keanggotaan, serta kelola perpanjangan status aktif.</p>
                <a href="/admin/member" class="text-emerald-600 font-semibold text-sm inline-flex items-center gap-1 hover:gap-2 transition-all">Buka Data Member &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">📝</div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Booking & Transaksi</h3>
                <p class="text-gray-500 text-sm mb-4 leading-relaxed">Catat jam bermain, hitung total tarif otomatis, kelola status uang muka (DP), dan cegah jadwal bentrok.</p>
                <a href="/admin/transaksi" class="text-amber-600 font-semibold text-sm inline-flex items-center gap-1 hover:gap-2 transition-all">Lihat Semua Jadwal &rarr;</a>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-400 text-xs">
            &copy; 2026 ProFutsal Arena Management. Built with Laravel & Tailwind CSS.
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>