<div class="max-w-xl mx-auto bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl border border-slate-100 dark:border-slate-700/50 shadow-sm animate-fade-in">
    <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 tracking-tight mb-6">
        {{ $paket?->exists ? 'Edit Paket Laundry' : 'Tambah Paket Laundry Baru' }}
    </h1>

    @if (session()->has('success'))
        <div class="mb-5 p-4 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-800/40 text-emerald-800 dark:text-emerald-300 rounded-2xl flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
            </div>
            <div class="text-sm font-semibold">{{ session('success') }}</div>
        </div>
    @endif

    <form wire:submit="simpan" class="space-y-5">
        {{-- Nama Paket --}}
        <div>
            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Nama Paket</label>
            <input wire:model.live="nama" type="text"
                class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl px-4 py-2.5 text-sm transition dark:text-slate-100 @error('nama') border-red-300 focus:ring-red-200 @enderror"
                placeholder="Contoh: Cuci Komplit, Setrika Saja..." />
            @error('nama') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
        </div>

        {{-- Harga --}}
        <div>
            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Harga per Satuan (Rp)</label>
            <div class="relative rounded-xl shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="text-slate-400 dark:text-slate-500 text-sm font-semibold">Rp</span>
                </div>
                <input wire:model.live="harga_per_kg" type="number" step="0.01"
                    class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl pl-10 pr-4 py-2.5 text-sm transition dark:text-slate-100 @error('harga_per_kg') border-red-300 focus:ring-red-200 @enderror"
                    placeholder="Contoh: 8000" />
            </div>
            @error('harga_per_kg') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
        </div>

        {{-- Satuan --}}
        <div>
            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-1.5">Satuan Pengukuran</label>
            <select wire:model.live="satuan" 
                class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl px-4 py-2.5 text-sm transition dark:text-slate-100">
                <option class="dark:bg-slate-800 dark:text-slate-100" value="kg">Kilogram (kg)</option>
                <option class="dark:bg-slate-800 dark:text-slate-100" value="item">Per Item / Potong</option>
            </select>
            @error('satuan') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-700/50">
            <button type="submit"
                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl transition shadow-md shadow-indigo-100 text-sm">
                {{ $paket?->exists ? 'Simpan Perubahan' : 'Buat Paket Baru' }}
            </button>
            <a href="{{ route('paket.index') }}" 
                class="bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 font-bold py-2.5 px-6 rounded-xl transition text-sm text-center">
                Batal
            </a>
        </div>
    </form>
</div>