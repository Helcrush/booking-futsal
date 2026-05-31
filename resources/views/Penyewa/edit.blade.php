<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penyewa</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Ubah Data Penyewa</h1>
            <p class="text-gray-500 text-sm">Perbarui informasi kontak untuk Penyewa: <strong class="text-gray-700">{{ $penyewa->nama }}</strong></p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/penyewa/{{ $penyewa->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Nama Penyewa</label>
                <input type="text" name="nama" value="{{ old('nama', $penyewa->nama) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama Lengkap / Nama Tim">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">No. WhatsApp / HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $penyewa->no_hp) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="08xxxxxxxxxx">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $penyewa->email) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="contoh@domain.com">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Alamat / Keterangan (Opsional)</label>
                <textarea name="alamat" rows="3" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis alamat rumah atau catatan tambahan pelanggan...">{{ old('alamat', $penyewa->alamat) }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="/penyewa" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg shadow transition cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>