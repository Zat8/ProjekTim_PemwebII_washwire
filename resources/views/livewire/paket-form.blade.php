<div class="max-w-2xl mx-auto bg-canvas dark:bg-ink p-8 border border-hairline dark:border-stone rounded-none space-y-8">
    <div class="pb-6 border-b border-hairline dark:border-stone">
        <h1 class="font-display uppercase text-[48px] leading-[0.9] text-ink dark:text-canvas tracking-tight">
            {{ $paket?->exists ? 'EDIT PAKET' : 'TAMBAH PAKET BARU' }}
        </h1>
        <p class="text-xs font-bold uppercase tracking-widest text-mute dark:text-stone mt-2">Atur detail paket laundry</p>
    </div>

    @if (session()->has('success'))
        <div class="border border-success bg-success-bright/10 p-4 text-success flex items-center gap-3 rounded-none">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            <div class="text-sm font-bold tracking-widest uppercase flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    <form wire:submit="simpan" class="space-y-6">
        {{-- Nama Paket --}}
        <div class="space-y-2">
            <label class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Nama Paket</label>
            <input wire:model.live="nama" type="text"
                class="flex h-12 w-full rounded-none border border-hairline bg-transparent px-4 py-2 text-base text-ink placeholder:text-mute focus:outline-none focus:ring-0 focus:border-ink dark:border-stone dark:text-canvas dark:focus:border-canvas transition-colors @error('nama') border-sale focus:border-sale @enderror"
                placeholder="Contoh: Cuci Komplit, Setrika Saja..." />
            @error('nama') <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Harga --}}
        <div class="space-y-2">
            <label class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Harga per Satuan (Rp)</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <span class="text-base text-mute dark:text-stone">Rp</span>
                </div>
                <input wire:model.live="harga_per_kg" type="number" step="0.01"
                    class="flex h-12 w-full rounded-none border border-hairline bg-transparent pl-12 pr-4 py-2 text-base text-ink placeholder:text-mute focus:outline-none focus:ring-0 focus:border-ink dark:border-stone dark:text-canvas dark:focus:border-canvas transition-colors @error('harga_per_kg') border-sale focus:border-sale @enderror"
                    placeholder="Contoh: 8000" />
            </div>
            @error('harga_per_kg') <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Satuan --}}
        <div class="space-y-2">
            <label class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Satuan Pengukuran</label>
            <select wire:model.live="satuan"
                class="flex h-12 w-full rounded-none border border-hairline bg-transparent px-4 py-2 text-base text-ink focus:outline-none focus:ring-0 focus:border-ink dark:border-stone dark:text-canvas dark:focus:border-canvas transition-colors">
                <option value="kg" class="dark:bg-ink">Kilogram (kg)</option>
                <option value="item" class="dark:bg-ink">Per Item / Potong</option>
            </select>
            @error('satuan') <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Alur Proses --}}
        <div class="space-y-2">
            <label class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Alur Proses Pengerjaan</label>
            <select wire:model.live="alur_proses"
                class="flex h-12 w-full rounded-none border border-hairline bg-transparent px-4 py-2 text-base text-ink focus:outline-none focus:ring-0 focus:border-ink dark:border-stone dark:text-canvas dark:focus:border-canvas transition-colors">
                <option value="cuci_setrika" class="dark:bg-ink">Cuci & Setrika (Antrean &rarr; Dicuci &rarr; Disetrika &rarr; Siap Diambil)</option>
                <option value="cuci_saja" class="dark:bg-ink">Cuci Saja (Antrean &rarr; Dicuci &rarr; Siap Diambil)</option>
                <option value="setrika_saja" class="dark:bg-ink">Setrika Saja (Antrean &rarr; Disetrika &rarr; Siap Diambil)</option>
            </select>
            @error('alur_proses') <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col sm:flex-row items-center gap-4 pt-8 border-t border-hairline dark:border-stone mt-8">
            <button type="submit"
                class="w-full sm:w-auto inline-flex items-center justify-center whitespace-nowrap rounded-full bg-ink px-8 py-3 text-[11px] font-bold uppercase tracking-widest text-canvas hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-ink focus:ring-offset-2 dark:bg-canvas dark:text-ink dark:focus:ring-canvas transition-colors">
                {{ $paket?->exists ? 'SIMPAN PERUBAHAN' : 'BUAT PAKET BARU' }}
            </button>
            <a href="{{ route('paket.index') }}"
                class="w-full sm:w-auto inline-flex items-center justify-center whitespace-nowrap rounded-full border border-ink bg-transparent px-8 py-3 text-[11px] font-bold uppercase tracking-widest text-ink hover:bg-soft-cloud focus:outline-none focus:ring-2 focus:ring-ink focus:ring-offset-2 dark:border-canvas dark:text-canvas dark:hover:bg-charcoal transition-colors">
                BATAL
            </a>
        </div>
    </form>
</div>
