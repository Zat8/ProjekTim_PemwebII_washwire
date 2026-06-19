<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        {{ $paket?->exists ? 'Edit Paket' : 'Tambah Paket Baru' }}
    </h1>

    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="simpan" class="space-y-4">
        {{-- Nama Paket --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Paket</label>
            <input wire:model.live="nama" type="text"
                class="w-full border rounded px-3 py-2 @error('nama') border-red-500 @enderror"
                placeholder="Contoh: Cuci Komplit" />
            @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Harga --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Kg/Item (Rp)</label>
            <input wire:model.live="harga_per_kg" type="number" step="0.01"
                class="w-full border rounded px-3 py-2 @error('harga_per_kg') border-red-500 @enderror"
                placeholder="Contoh: 8000" />
            @error('harga_per_kg') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Satuan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
            <select wire:model.live="satuan" class="w-full border rounded px-3 py-2">
                <option value="kg">Kg</option>
                <option value="item">Item</option>
            </select>
            @error('satuan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                {{ $paket?->exists ? 'Perbarui' : 'Simpan' }}
            </button>
            <a href="{{ route('paket.index') }}" wire:navigate
                class="bg-gray-200 text-gray-700 px-6 py-2 rounded hover:bg-gray-300">
                Batal
            </a>
        </div>
    </form>
</div>