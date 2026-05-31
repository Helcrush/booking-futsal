<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jadwal Lapangan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Jadwal Lapangan</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola slot jam operasional dan status masing-masing lapangan.</p>
            </div>
            <div class="flex gap-2">
                <a href="/jadwal/tersedia" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded shadow text-sm transition">
                    🔍 Cek Slot Kosong
                </a>
                <a href="/jadwal/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm transition">
                    + Tambah Slot Jadwal
                </a>
            </div>
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
                        <th class="p-3 border-b">Nama Lapangan</th>
                        <th class="p-3 border-b">Jam Mulai</th>
                        <th class="p-3 border-b">Jam Selesai</th>
                        <th class="p-3 border-b text-center">Status</th>
                        <th class="p-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($jadwal as $j)
                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                            <td class="p-3 font-semibold text-gray-800">{{ $j->lapangan->nama_lapangan }}</td>
                            <td class="p-3 font-mono text-gray-700">{{ date('H:i', strtotime($j->jam_mulai)) }} WIB</td>
                            <td class="p-3 font-mono text-gray-700">{{ date('H:i', strtotime($j->jam_selesai)) }} WIB</td>
                            <td class="p-3 text-center">
                                @if($j->status === 'tersedia')
                                    <span class="bg-green-100 text-green-800 text-xs px-2.5 py-1 rounded-full font-semibold uppercase">Tersedia</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs px-2.5 py-1 rounded-full font-semibold uppercase">Dipesan</span>
                                @endif
                            </td>
                            <td class="p-3 text-center flex justify-center gap-2">
                                <a href="/jadwal/{{ $j->id }}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition">
                                    Edit
                                </a>
                                <form action="/jadwal/{{ $j->id }}" method="POST" onsubmit="return confirm('Hapus slot jadwal ini?')">
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
                            <td colspan="5" class="p-4 text-center text-gray-400">Belum ada master jadwal yang dibuat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>