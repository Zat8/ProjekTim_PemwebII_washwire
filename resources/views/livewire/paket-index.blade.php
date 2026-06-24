<div class="space-y-8">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="border border-success bg-success-bright/10 p-4 text-success flex items-center gap-3 rounded-none">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            <div class="text-sm font-bold tracking-widest uppercase flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 pb-6 border-b border-hairline dark:border-stone">
        <div>
            <h1 class="font-display uppercase text-[48px] leading-[0.9] text-ink dark:text-canvas tracking-tight">KELOLA PAKET</h1>
            <p class="text-xs font-bold uppercase tracking-widest text-mute dark:text-stone mt-2">Daftar tarif dan paket laundry</p>
        </div>
        <a href="{{ route('paket.buat') }}"
            class="inline-flex items-center justify-center whitespace-nowrap rounded-full bg-ink px-6 py-3 text-[11px] font-bold uppercase tracking-widest text-canvas hover:opacity-80 transition-opacity gap-2 dark:bg-canvas dark:text-ink">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Tambah Paket Baru
        </a>
    </div>

    {{-- Tabel Paket --}}
    <div class="bg-canvas dark:bg-ink border border-hairline dark:border-stone rounded-none">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-soft-cloud dark:bg-charcoal border-b border-hairline dark:border-stone">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Nama Paket</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Alur Proses</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Harga per Satuan</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Satuan</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-hairline dark:divide-stone">
                    @forelse ($pakets as $paket)
                        <tr class="hover:bg-soft-cloud dark:hover:bg-charcoal transition-colors">
                            <td class="px-6 py-4 font-bold text-ink dark:text-canvas">{{ $paket->nama }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $alurLabel = match($paket->alur_proses) {
                                        'cuci_saja' => 'Cuci Saja',
                                        'setrika_saja' => 'Setrika Saja',
                                        default => 'Cuci & Setrika',
                                    };
                                    $alurSteps = match($paket->alur_proses) {
                                        'cuci_saja' => 'Antrean ➔ Dicuci ➔ Siap Diambil',
                                        'setrika_saja' => 'Antrean ➔ Disetrika ➔ Siap Diambil',
                                        default => 'Antrean ➔ Dicuci ➔ Disetrika ➔ Siap Diambil',
                                    };
                                @endphp
                                <div class="font-bold text-ink dark:text-canvas text-xs uppercase tracking-widest">{{ $alurLabel }}</div>
                                <div class="text-[10px] text-mute dark:text-stone mt-1 uppercase tracking-widest">{{ $alurSteps }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-ink dark:text-canvas">
                                Rp {{ number_format($paket->harga_per_kg, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-none border border-ink bg-canvas px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-widest text-ink dark:border-canvas dark:bg-ink dark:text-canvas">
                                    per {{ $paket->satuan }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('paket.edit', $paket) }}"
                                       class="inline-flex items-center justify-center rounded-full bg-soft-cloud dark:bg-charcoal h-9 w-9 text-ink dark:text-canvas hover:bg-hairline-soft dark:hover:bg-ash transition-colors"
                                       title="Edit Paket">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <button wire:click="hapus({{ $paket->id }})"
                                        wire:confirm="Yakin ingin menghapus paket ini?"
                                        class="inline-flex items-center justify-center rounded-full bg-soft-cloud dark:bg-charcoal h-9 w-9 text-sale hover:bg-sale hover:text-canvas dark:hover:bg-sale transition-colors"
                                        title="Hapus Paket">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-mute dark:text-stone">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-12 h-12 rounded-full border border-hairline dark:border-stone flex items-center justify-center text-ink dark:text-canvas">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586-3.586a2 2 0 00-2.828 0L16 12m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 10" /></svg>
                                    </div>
                                    <p class="text-xs font-bold uppercase tracking-widest mt-2">Belum ada paket terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $pakets->links() }}
    </div>
</div>
