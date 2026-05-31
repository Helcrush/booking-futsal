<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lapangan Baru</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Lapangan Baru</h1>
            <p class="text-gray-500 text-sm">Silakan isi formulir di bawah ini dengan lengkap.</p>
        </div>

        <form action="/lapangan" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Nama Lapangan</label>
                <input type="text" name="nama_lapangan" value="{{ old('nama_lapangan') }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_lapangan') border-red-500 @enderror" placeholder="Contoh: Lapangan A (Sintetis)">
                @error('nama_lapangan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Jenis Rumput / Lantai</label>
                <input type="text" name="jenis_rumput" value="{{ old('jenis_rumput') }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jenis_rumput') border-red-500 @enderror" placeholder="Contoh: Rumput Sintetis / Vinyl / Matras">
                @error('jenis_rumput') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Harga Sewa Per Jam (Rp)</label>
                <input type="number" name="harga_per_jam" value="{{ old('harga_per_jam') }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('harga_per_jam') border-red-500 @enderror" placeholder="Contoh: 150000">
                @error('harga_per_jam') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="3" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Fasilitas tambahan lapangan..."></textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="/lapangan" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">Simpan Lapangan</button>
            </div>
        </form>
    </div>
</body>
</html>