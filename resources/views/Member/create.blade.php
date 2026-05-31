<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Member Baru</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftarkan Member Baru</h1>
            <p class="text-gray-500 text-sm">Pilih data penyewa yang ingin dinaikkan statusnya menjadi member.</p>
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

        <form action="/member" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Pilih Penyewa / Tim</label>
                <select name="penyewa_id" class="w-full p-2.5 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Penyewa --</option>
                    @foreach($penyewa as $p)
                        <option value="{{ $p->id }}" {{ old('penyewa_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_tim }} (Penanggung Jawab: {{ $p->nama_penyewa }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Kode Member (Kartu)</label>
                <input type="text" name="kode_member" value="{{ old('kode_member', 'MBR-'.rand(1000, 9999)) }}" class="w-full p-2.5 border rounded-lg bg-gray-50 font-mono font-bold text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: MBR-001">
                <p class="text-gray-400 text-xs mt-1">*Kode di atas dibuat otomatis, Anda bisa mengubahnya manual jika perlu.</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Tanggal Mulai Aktif</label>
                    <input type="date" name="tanggal_join" value="{{ old('tanggal_join', date('Y-m-d')) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Tanggal Berakhir (Kadaluarsa)</label>
                    <input type="date" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa', date('Y-m-d', strtotime('+1 year'))) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Status Awal Keanggotaan</label>
                <select name="status_member" class="w-full p-2.5 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="aktif" {{ old('status_member') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status_member') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="/member" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition-all cursor-pointer">Aktifkan Member</button>
            </div>
        </form>
    </div>
</body>
</html>