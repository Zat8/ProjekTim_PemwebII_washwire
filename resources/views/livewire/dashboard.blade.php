<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Selamat datang, {{ auth()->user()->name }}!
        </h1>
        <p class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>

    {{-- Kartu Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500 mb-1">Total Transaksi Hari Ini</p>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalTransaksiHariIni }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500 mb-1">Pemasukan Hari Ini</p>
            <p class="text-3xl font-bold text-green-600">
                Rp {{ number_format($pemasukanHariIni, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-sm text-gray-500 mb-1">Cucian Belum Diambil</p>
            <p class="text-3xl font-bold text-orange-600">{{ $cucianPending }}</p>
        </div>
    </div>

    {{-- Transaksi Terakhir --}}
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h2 class="font-semibold text-gray-700">5 Transaksi Terakhir</h2>
        </div>
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">No. Nota</th>
                    <th class="px-6 py-3">Pelanggan</th>
                    <th class="px-6 py-3">Paket</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksiTerakhir as $transaksi)
                    <tr class="border-t">
                        <td class="px-6 py-3 font-medium">{{ $transaksi->no_nota }}</td>
                        <td class="px-6 py-3">{{ $transaksi->nama_pelanggan }}</td>
                        <td class="px-6 py-3">{{ $transaksi->paket->nama }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">{{ str_replace('_', ' ', ucfirst($transaksi->status)) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-400">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>