<div class="space-y-8">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="border border-success bg-success-bright/10 p-4 text-success flex items-center gap-3 rounded-none">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            <div class="text-sm font-bold tracking-widest uppercase flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 pb-6 border-b border-hairline dark:border-stone">
        <div>
            <h1 class="font-display uppercase text-[48px] leading-[0.9] text-ink dark:text-canvas tracking-tight">STATUS CUCIAN</h1>
            <p class="text-xs font-bold uppercase tracking-widest text-mute dark:text-stone mt-2">Kelola siklus pengerjaan pakaian pelanggan</p>
        </div>

        {{-- Search --}}
        <div class="relative w-full md:w-80">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-mute dark:text-stone" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input wire:model.live="search" type="text" placeholder="CARI NO. NOTA ATAU NAMA..."
                class="flex h-12 w-full rounded-none border border-hairline bg-transparent pl-12 pr-4 py-2 text-base text-ink placeholder:text-mute focus:outline-none focus:ring-0 focus:border-ink dark:border-stone dark:text-canvas dark:placeholder:text-stone transition-colors placeholder:uppercase placeholder:text-xs placeholder:font-bold placeholder:tracking-widest" />
        </div>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="bg-canvas dark:bg-ink border border-hairline dark:border-stone rounded-none">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-soft-cloud dark:bg-charcoal border-b border-hairline dark:border-stone">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">No. Nota</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Pelanggan</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Paket</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Total Harga</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Tanggal Masuk</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas text-center">Status Pengerjaan</th>
                        <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-hairline dark:divide-stone">
                    @forelse ($transaksis as $transaksi)
                        <tr class="hover:bg-soft-cloud dark:hover:bg-charcoal transition-colors">
                            <td class="px-6 py-4 font-bold text-ink dark:text-canvas">{{ $transaksi->no_nota }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-ink dark:text-canvas">{{ $transaksi->nama_pelanggan }}</div>
                                <div class="text-[10px] text-mute dark:text-stone mt-1 uppercase tracking-widest">{{ $transaksi->no_hp ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-ink dark:text-canvas">{{ $transaksi->paket->nama }}</div>
                                <div class="text-[10px] text-mute dark:text-stone mt-1 uppercase tracking-widest">{{ $transaksi->berat }} kg</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-ink dark:text-canvas">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-ink dark:text-canvas uppercase tracking-widest text-xs">
                                    {{ $transaksi->created_at->format('d M Y') }}
                                </div>
                                <div class="text-[10px] text-mute dark:text-stone mt-1 uppercase tracking-widest">
                                    {{ $transaksi->created_at->format('H:i') }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($transaksi->status !== 'siap_diambil')
                                    <button wire:click="ubahStatus({{ $transaksi->id }})" @class([
                                        'inline-flex items-center rounded-none border px-3 py-1 text-[10px] font-bold uppercase tracking-widest transition-colors focus:outline-none focus:ring-0 cursor-pointer gap-2',
                                        // Antrean: Neutral
                                        'border-ink bg-canvas text-ink hover:bg-ink hover:text-canvas dark:border-canvas dark:bg-ink dark:text-canvas dark:hover:bg-canvas dark:hover:text-ink' => $transaksi->status === 'antrean',
                                        // Dicuci: High contrast
                                        'border-ink bg-ink text-canvas hover:bg-canvas hover:text-ink dark:border-canvas dark:bg-canvas dark:text-ink dark:hover:bg-ink dark:hover:text-canvas' => $transaksi->status === 'dicuci',
                                        // Disetrika: Subtle outline
                                        'border-hairline bg-soft-cloud text-ink hover:border-ink dark:border-stone dark:bg-charcoal dark:text-canvas dark:hover:border-canvas' => $transaksi->status === 'disetrika',
                                    ]) title="Klik untuk lanjut ke status berikutnya">
                                        {{ str_replace('_', ' ', $transaksi->status) }}
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                @else
                                    <span class="inline-flex items-center rounded-none border border-success bg-success text-canvas px-3 py-1 text-[10px] font-bold uppercase tracking-widest dark:bg-success-bright dark:border-success-bright dark:text-ink gap-2">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        SIAP DIAMBIL
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('struk.cetak', $transaksi) }}" target="_blank"
                                        class="inline-flex items-center justify-center rounded-full bg-soft-cloud dark:bg-charcoal text-ink dark:text-canvas hover:bg-hairline-soft dark:hover:bg-ash h-10 w-10 transition-colors" title="Cetak Ulang">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12 text-mute dark:text-stone">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-12 h-12 rounded-full border border-hairline dark:border-stone flex items-center justify-center text-ink dark:text-canvas">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest mt-2">Tidak menemukan transaksi yang cocok.</p>
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
        {{ $transaksis->links() }}
    </div>
</div>