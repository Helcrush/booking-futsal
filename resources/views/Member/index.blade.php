<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member Futsal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Keanggotaan (Member)</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola data penyewa yang terdaftar sebagai member resmi.</p>
            </div>
            <a href="/member/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm transition">
                + Daftarkan Member Baru
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
                        <th class="p-3 border-b">Kode Member</th>
                        <th class="p-3 border-b">Nama Tim / Penyewa</th>
                        <th class="p-3 border-b">Tanggal Join</th>
                        <th class="p-3 border-b">Masa Berlaku</th>
                        <th class="p-3 border-b text-center">Status</th>
                        <th class="p-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($member as $m)
                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                            <td class="p-3 font-mono font-bold text-blue-600">{{ $m->kode_member }}</td>
                            <td class="p-3 font-semibold text-gray-800">{{ $m->penyewa->nama_tim ?? $m->penyewa->nama_penyewa }}</td>
                            
                            <td class="p-3">{{ date('d M Y', strtotime($m->tanggal_join)) }}</td>
                            <td class="p-3 font-medium text-amber-700">{{ date('d M Y', strtotime($m->tanggal_kadaluarsa)) }}</td>
                            
                            <td class="p-3 text-center">
                                @if($m->status_member === 'aktif')
                                    <span class="bg-green-100 text-green-800 text-xs px-2.5 py-1 rounded-full font-semibold uppercase">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs px-2.5 py-1 rounded-full font-semibold uppercase">Non-Aktif</span>
                                @endif
                            </td>
                            
                            <td class="p-3 text-center flex justify-center gap-2">
                                <a href="/member/{{ $m->id }}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition">
                                    Perpanjang / Edit
                                </a>
                                <form action="/member/{{ $m->id }}" method="POST" onsubmit="return confirm('Hapus status keanggotaan member ini?')">
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
                            <td colspan="6" class="p-4 text-center text-gray-400">Belum ada penyewa yang mendaftar jadi member.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>