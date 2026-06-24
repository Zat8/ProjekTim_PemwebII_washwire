<div class="max-w-xl mx-auto bg-white dark:bg-zinc-900 p-6 md:p-8 rounded-lg border border-zinc-200 dark:border-zinc-800 space-y-6">
    <h1 class="text-xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight">
        {{ $paket?->exists ? 'Edit Paket Laundry' : 'Tambah Paket Laundry Baru' }}
    </h1>

    @if (session()->has('success'))
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/50 dark:text-emerald-300 flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            <div class="text-sm font-medium flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    <form wire:submit="simpan" class="space-y-5">
        {{-- Nama Paket --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Nama Paket</label>
            <input wire:model.live="nama" type="text"
                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 transition-colors @error('nama') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                placeholder="Contoh: Cuci Komplit, Setrika Saja..." />
            @error('nama') <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Harga --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Harga per Satuan (Rp)</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">Rp</span>
                </div>
                <input wire:model.live="harga_per_kg" type="number" step="0.01"
                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white pl-10 pr-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 transition-colors @error('harga_per_kg') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                    placeholder="Contoh: 8000" />
            </div>
            @error('harga_per_kg') <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Satuan --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Satuan Pengukuran</label>
            <select wire:model.live="satuan"
                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 transition-colors">
                <option value="kg">Kilogram (kg)</option>
                <option value="item">Per Item / Potong</option>
            </select>
            @error('satuan') <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Alur Proses --}}
        <div class="space-y-2">
            <label class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Alur Proses Pengerjaan</label>
            <select wire:model.live="alur_proses"
                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 transition-colors">
                <option value="cuci_setrika">Cuci & Setrika (Antrean &rarr; Dicuci &rarr; Disetrika &rarr; Siap Diambil)</option>
                <option value="cuci_saja">Cuci Saja (Antrean &rarr; Dicuci &rarr; Siap Diambil)</option>
                <option value="setrika_saja">Setrika Saja (Antrean &rarr; Disetrika &rarr; Siap Diambil)</option>
            </select>
            @error('alur_proses') <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center gap-3 pt-6 border-t border-zinc-200 dark:border-zinc-800">
            <button type="submit"
                class="flex-1 inline-flex items-center justify-center whitespace-nowrap rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 dark:bg-zinc-50 dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors">
                {{ $paket?->exists ? 'Simpan Perubahan' : 'Buat Paket Baru' }}
            </button>
            <a href="{{ route('paket.index') }}"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-200 focus:ring-offset-2 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-300 dark:hover:bg-zinc-800 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
