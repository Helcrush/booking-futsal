<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking Futsal</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Transaksi / Booking</h1>
                <p class="text-gray-500 text-sm mt-1">Pantau jadwal pemakaian lapangan futsal dan status pembayaran.</p>
            </div>
            <a href="/transaksi/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm transition">
                + Buat Booking Baru
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
                        <th class="p-3 border-b">Penyewa</th>
                        <th class="p-3 border-b">Lapangan</th>
                        <th class="p-3 border-b">Jadwal Main</th>
                        <th class="p-3 border-b">Durasi</th>
                        <th class="p-3 border-b">Total Biaya</th>
                        <th class="p-3 border-b text-center">Status</th>
                        <th class="p-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($transaksi as $t)
                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                            <td class="p-3 font-semibold text-gray-800">
                                {{ $t->penyewa->nama ?? 'Umum/Terhapus' }}
                            </td>
                            <td class="p-3">
                                <span class="bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded font-medium">
                                    {{ $t->lapangan->nama_lapangan ?? 'Lapangan' }}
                                </span>
                            </td>
                            <td class="p-3">
                                <div class="font-medium text-gray-700">{{ date('d M Y', strtotime($t->tanggal_main)) }}</div>
                                <div class="text-xs text-gray-400 font-mono">{{ date('H:i', strtotime($t->jam_mulai)) }} - {{ date('H:i', strtotime($t->jam_selesai)) }} WIB</div>
                            </td>
                            <td class="p-3 font-mono">{{ $t->durasi_jam }} Jam</td>
                            <td class="p-3 font-semibold text-gray-900">
                                Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                                @if($t->status_pembayaran === 'dp')
                                    <div class="text-xs text-amber-600 font-normal">Paid DP: Rp {{ number_format($t->dp_dibayar, 0, ',', '.') }}</div>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if($t->status_pembayaran === 'lunas')
                                    <span class="bg-green-100 text-green-800 text-xs px-2.5 py-1 rounded-full font-semibold uppercase">Lunas</span>
                                @elseif($t->status_pembayaran === 'dp')
                                    <span class="bg-amber-100 text-amber-800 text-xs px-2.5 py-1 rounded-full font-semibold uppercase">DP (Uang Muka)</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs px-2.5 py-1 rounded-full font-semibold uppercase">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="p-3 text-center flex justify-center gap-2">
                                <a href="/transaksi/{{ $t->id }}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition">
                                    Edit / Bayar
                                </a>
                                <form action="/transaksi/{{ $t->id }}" method="POST" onsubmit="return confirm('Batalkan booking jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition cursor-pointer">
                                        Batal
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-4 text-center text-gray-400">Belum ada agenda booking lapangan untuk saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>