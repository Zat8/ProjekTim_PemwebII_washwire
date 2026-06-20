<div>
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Papan Pelacakan Status</h1>
        <p class="text-sm text-gray-500">Klik badge status untuk memperbarui ke tahap selanjutnya</p>
    </div>

    {{-- Live Search --}}
    <div class="mb-4">
        <input wire:model.live="search" type="text" placeholder="Cari no. nota atau nama pelanggan..."
            class="border rounded px-3 py-2 w-full md:w-1/3" />
    </div>

    {{-- Tabel Transaksi --}}
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">No. Nota</th>
                    <th class="px-4 py-3">Pelanggan</th>
                    <th class="px-4 py-3">Paket</th>
                    <th class="px-4 py-3">Berat</th>
                    <th class="px-4 py-3">Total Harga</th>
                    <th class="px-4 py-3">Tanggal Masuk</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $transaksi->no_nota }}</td>
                        <td class="px-4 py-3">{{ $transaksi->nama_pelanggan }}</td>
                        <td class="px-4 py-3">{{ $transaksi->paket->nama }}</td>
                        <td class="px-4 py-3">{{ $transaksi->berat }} kg</td>
                        <td class="px-4 py-3">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $transaksi->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <button wire:click="ubahStatus({{ $transaksi->id }})"
                                @class([
                                    'px-3 py-1 rounded-full text-xs font-semibold transition',
                                    'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' => $transaksi->status === 'antrean',
                                    'bg-blue-100 text-blue-700 hover:bg-blue-200' => $transaksi->status === 'dicuci',
                                    'bg-orange-100 text-orange-700 hover:bg-orange-200' => $transaksi->status === 'disetrika',
                                    'bg-green-100 text-green-700' => $transaksi->status === 'siap_diambil',
                                ])
                                @disabled($transaksi->status === 'siap_diambil')>
                                {{ str_replace('_', ' ', ucfirst($transaksi->status)) }}
                            </button>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('struk.cetak', $transaksi) }}" target="_blank"
                                class="text-indigo-600 hover:underline text-xs">
                                Cetak Ulang Struk
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-400">Tidak ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $transaksis->links() }}
    </div>
</div>