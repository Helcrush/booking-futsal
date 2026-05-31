<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lapangan Futsal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Lapangan Futsal</h1>
            <a href="/lapangan/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                + Tambah Lapangan
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                        <th class="p-3 border-b">Nama Lapangan</th>
                        <th class="p-3 border-b">Jenis Rumput</th>
                        <th class="p-3 border-b">Harga / Jam</th>
                        <th class="p-3 border-b">Deskripsi</th>
                        <th class="p-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($lapangan as $lap)
                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                            <td class="p-3 font-semibold text-gray-800">{{ $lap->nama_lapangan }}</td>
                            <td class="p-3">{{ $lap->jenis_rumput }}</td>
                            <td class="p-3 text-green-600 font-bold">Rp {{ number_format($lap->harga_per_jam, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $lap->deskripsi ?? '-' }}</td>
                            <td class="p-3 text-center flex justify-center gap-2">
                                <a href="/lapangan/{{ $lap->id }}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition">
                                    Edit
                                </a>
                                <form action="/lapangan/{{ $lap->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lapangan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400">Belum ada data lapangan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>