<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpanjang Masa Aktif Member</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Perbarui / Perpanjang Member</h1>
            <p class="text-gray-500 text-sm">Mengedit data kartu member untuk Tim: <strong class="text-gray-700">{{ $member->penyewa->nama_tim ?? $member->penyewa->nama_penyewa }}</strong></p>
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

        <form action="/member/{{ $member->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <input type="hidden" name="penyewa_id" value="{{ $member->penyewa_id }}">

            <div class="mb-4">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Kode Member (Tidak Dapat Diubah)</label>
                <input type="text" name="kode_member" value="{{ $member->kode_member }}" readonly class="w-full p-2.5 border rounded-lg bg-gray-100 font-mono font-bold text-gray-400 cursor-not-allowed">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Tanggal Join</label>
                    <input type="date" name="tanggal_join" value="{{ old('tanggal_join', $member->tanggal_join) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Tanggal Kadaluarsa Baru</label>
                    <input type="date" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa', $member->tanggal_kadaluarsa) }}" class="w-full p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Status Keanggotaan</label>
                <select name="status_member" class="w-full p-2.5 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="aktif" {{ old('status_member', $member->status_member) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status_member', $member->status_member) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="/member" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg shadow transition-all cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>