<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Slot Jadwal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Slot Jadwal</h1>
            <p class="text-gray-500 text-sm">Ubah detail jam atau ketersediaan operasional lapangan.</p>
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

        <form action="/jadwal/{{ $jadwal->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Pilih Lapangan</label>
                <select name="lapangan_id" class="w-full p-2.5 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($lapangan as $lap)
                        <option value="{{ $lap->id }}" {{ old('lapangan_id', $jadwal->lapangan_id) == $lap->id ? 'selected' : '' }}>
                            {{ $lap->nama_lapangan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="{{ old('jam_mulai', date('H:i', strtotime($jadwal->jam_mulai))) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" value="{{ old('jam_selesai', date('H:i', strtotime($jadwal->jam_selesai))) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Status Jadwal</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="tersedia" {{ old('status', $jadwal->status) === 'tersedia' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-gray-700 text-sm">Tersedia (Kosong)</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="dipesan" {{ old('status', $jadwal->status) === 'dipesan' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-gray-700 text-sm">Dipesan (Booked)</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="/jadwal" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg shadow transition">Perbarui Jadwal</button>
            </div>
        </form>
    </div>
</body>
</html>