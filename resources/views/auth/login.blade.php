<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Arena Futsal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 font-sans antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center p-6">
        <div class="mb-8 text-center">
            <span class="text-4xl">⚽</span>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight mt-2">ARENA FUTSAL</h1>
            <p class="text-slate-500 text-sm">Sistem Manajemen Booking Admin</p>
        </div>

        <div class="w-full max-w-sm bg-white p-8 rounded-2xl border border-slate-200 shadow-xl shadow-slate-200/50">
            <h2 class="text-xl font-bold text-slate-900 mb-6">Login Ke Dashboard</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    @error('email') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Password</label>
                    <input type="password" name="password" required 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 rounded-xl transition shadow-lg shadow-slate-900/20">
                    MASUK SEKARANG
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="text-xs font-semibold text-slate-400 hover:text-blue-600 transition">
                    &larr; Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>

</body>
</html>