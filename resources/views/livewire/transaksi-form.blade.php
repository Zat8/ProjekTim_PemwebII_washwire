<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Buat Transaksi Baru</h1>

    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="simpan" class="space-y-4">
        {{-- Nama Pelanggan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
            <input wire:model.live="nama_pelanggan" type="text"
                class="w-full border rounded px-3 py-2 @error('nama_pelanggan') border-red-500 @enderror"
                placeholder="Masukkan nama pelanggan" />
            @error('nama_pelanggan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- No HP --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
            <input wire:model.live="no_hp" type="text"
                class="w-full border rounded px-3 py-2 @error('no_hp') border-red-500 @enderror"
                placeholder="Contoh: 081234567890" />
            @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Jenis Paket & Berat --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Paket</label>
                <select wire:model.live="paket_laundry_id"
                    class="w-full border rounded px-3 py-2 @error('paket_laundry_id') border-red-500 @enderror">
                    <option value="">Pilih Paket</option>
                    @foreach ($pakets as $paket)
                        <option value="{{ $paket->id }}">
                            {{ $paket->nama }} (Rp {{ number_format($paket->harga_per_kg, 0, ',', '.') }}/{{ $paket->satuan }})
                        </option>
                    @endforeach
                </select>
                @error('paket_laundry_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Berat (Kg)</label>
                <input wire:model.live="berat" type="number" step="0.1"
                    class="w-full border rounded px-3 py-2 @error('berat') border-red-500 @enderror"
                    placeholder="Contoh: 2.5" />
                @error('berat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Total Harga (Real-time) --}}
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-600 mb-1">Total Harga</p>
            <p class="text-4xl font-bold text-indigo-700">
                Rp {{ number_format($this->totalHarga, 0, ',', '.') }}
            </p>
        </div>

        {{-- Tombol --}}
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 w-full">
                Simpan Transaksi & Cetak Nota
            </button>
        </div>
    </form>
</div>