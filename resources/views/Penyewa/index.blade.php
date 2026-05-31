<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penyewa Futsal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Data Penyewa</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola data pelanggan, email aktif, dan kontak penanggung jawab.</p>
            </div>
            <a href="/penyewa/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm transition">
                + Tambah Penyewa Baru
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
                    <tr class="bg-gray-200 text-gray-700 uppercase text-xs tracking-wider">
                        <th class="p-3 border-b">Nama Penyewa</th>
                        <th class="p-3 border-b">No. HP / WhatsApp</th>
                        <th class="p-3 border-b">Email</th>
                        <th class="p-3 border-b">Alamat</th>
                        <th class="p-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($penyewa as $p)
                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                            <!-- Menyesuaikan dengan properti Model baru -->
                            <td class="p-3 font-semibold text-gray-800">{{ $p->nama }}</td>
                            <td class="p-3 font-mono text-blue-600">{{ $p->no_hp }}</td>
                            <td class="p-3">{{ $p->email }}</td>
                            <td class="p-3 text-gray-500">{{ $p->alamat ?? '-' }}</td>
                            <td class="p-3 text-center flex justify-center gap-2">
                                <!-- Mengarahkan ke route show controller untuk melihat riwayat transaksi -->
                                <a href="/penyewa/{{ $p->id }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded text-xs transition">
                                    📜 History
                                </a>
                                <a href="/penyewa/{{ $p->id }}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition">
                                    Edit
                                </a>
                                <form action="/penyewa/{{ $p->id }}" method="POST" onsubmit="return confirm('Hapus data penyewa ini? Semua data terkait mungkin akan terpengaruh.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400">Belum ada data penyewa yang terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>