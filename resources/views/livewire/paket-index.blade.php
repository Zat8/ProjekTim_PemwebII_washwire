<div>
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Master Data Paket Laundry</h1>
        <a href="{{ route('paket.buat') }}" wire:navigate
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Paket
        </a>
    </div>

    {{-- Tabel Paket --}}
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Nama Paket</th>
                    <th class="px-4 py-3">Harga / Kg</th>
                    <th class="px-4 py-3">Satuan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pakets as $paket)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $paket->nama }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($paket->harga_per_kg, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $paket->satuan }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('paket.edit', $paket) }}" wire:navigate
                                class="text-indigo-600 hover:underline text-xs">Edit</a>
                            <button wire:click="hapus({{ $paket->id }})"
                                wire:confirm="Yakin ingin menghapus paket ini?"
                                class="text-red-600 hover:underline text-xs">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-400">Belum ada paket.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $pakets->links() }}
    </div>
</div>