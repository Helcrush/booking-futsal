<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Lapangan Baru</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Buat Booking Lapangan</h1>
            <p class="text-gray-500 text-sm">Sistem akan otomatis menghitung total biaya sewa dan mengecek ketersediaan jam.</p>
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

        <form action="/transaksi" method="POST">
            @csrf
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Pilih Penyewa / Club</label>
                    <select name="penyewa_id" class="w-full p-2.5 border rounded-lg bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($penyewa as $p)
                            <option value="{{ $p->id }}" {{ old('penyewa_id') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Pilih Lapangan</label>
                    <select name="lapangan_id" class="w-full p-2.5 border rounded-lg bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">-- Pilih Jenis Lapangan --</option>
                        @foreach($lapangan as $l)
                            <option value="{{ $l->id }}" {{ old('lapangan_id') == $l->id ? 'selected' : '' }}>{{ $l->nama_lapangan }} (Rp {{ number_format($l->harga_per_jam, 0, ',', '.') }}/jam)</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Tanggal Main</label>
                <input type="date" name="tanggal_main" value="{{ old('tanggal_main', date('Y-m-d')) }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">DP Dibayar (Rp)</label>
                    <input type="number" name="dp_dibayar" value="{{ old('dp_dibayar', 0) }}" min="0" class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="0">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Status Bayar</label>
                    <select name="status_pembayaran" class="w-full p-2.5 border rounded-lg bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="belum_bayar" {{ old('status_pembayaran') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="dp" {{ old('status_pembayaran') == 'dp' ? 'selected' : '' }}>DP (Down Payment)</option>
                        <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="w-full p-2.5 border rounded-lg bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="cash" {{ old('metode_pembayaran') == 'cash' ? 'selected' : '' }}>Cash (Tunai)</option>
                        <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="/transaksi" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition cursor-pointer">Simpan Booking</button>
            </div>
        </form>
    </div>
</body>
</html>