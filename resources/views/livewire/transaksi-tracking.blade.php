<div class="space-y-6">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div
            class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/50 dark:text-emerald-300 flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <div class="text-sm font-medium flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight">Pelacakan & Status Cucian
            </h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Kelola siklus pengerjaan pakaian pelanggan secara
                real-time</p>
        </div>

        {{-- Search --}}
        <div class="relative w-full md:w-80">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input wire:model.live="search" type="text" placeholder="Cari no. nota atau nama..."
                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white pl-9 pr-4 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#9737e3]/20 focus:border-[#9737e3] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 transition-colors" />
        </div>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                    <tr>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">No. Nota</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Pelanggan</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Paket</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Total Harga</th>
                        <th class="px-6 py-3
                         font-medium text-zinc-500 dark:text-zinc-400">Tanggal Masuk</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400 text-center">Status Pengerjaan
                        </th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse ($transaksis as $transaksi)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-100">{{ $transaksi->no_nota }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">{{ $transaksi->nama_pelanggan }}
                                </div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">{{ $transaksi->no_hp ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-zinc-900 dark:text-zinc-100 font-medium">{{ $transaksi->paket->nama }}
                                </div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">{{ $transaksi->berat }} kg
                                </div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-zinc-900 dark:text-zinc-100">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-zinc-900 dark:text-zinc-100 font-medium">
                                    {{ $transaksi->created_at->format('d M Y') }}</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">
                                    {{ $transaksi->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($transaksi->status !== 'siap_diambil')
                                    <button wire:click="ubahStatus({{ $transaksi->id }})" @class([
                                        'inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 cursor-pointer gap-1.5 dark:focus:ring-zinc-300',
                                        // Antrean: Secondary/Neutral
                                        'border-zinc-200 bg-zinc-100 text-zinc-800 hover:bg-zinc-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700' => $transaksi->status === 'antrean',
                                        // Dicuci: Accent (10% rule)
                                        'border-[#9737e3]/20 bg-[#9737e3]/10 text-[#9737e3] hover:bg-[#9737e3]/20 dark:border-[#9737e3]/30 dark:bg-[#9737e3]/20' => $transaksi->status === 'dicuci',
                                        // Disetrika: Warning/In-progress (Subtle)
                                        'border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100 dark:border-amber-900/50 dark:bg-amber-950/50 dark:text-amber-300 dark:hover:bg-amber-950' => $transaksi->status === 'disetrika',
                                    ]) title="Klik untuk lanjut ke status berikutnya">
                                        {{ str_replace('_', ' ', ucfirst($transaksi->status)) }}
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-md border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/50 dark:text-emerald-300 gap-1.5">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Siap Diambil
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('struk.cetak', $transaksi) }}" target="_blank"
                                        class="inline-flex items-center justify-center rounded-md text-xs font-medium border border-zinc-200 bg-white hover:bg-zinc-100 hover:text-zinc-900 dark:border-zinc-800 dark:bg-zinc-950 dark:hover:bg-zinc-800 dark:hover:text-zinc-50 h-8 px-3 gap-1.5 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9" />
                                        </svg>
                                        Cetak Ulang
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12 text-zinc-500 dark:text-zinc-400">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-zinc-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium">Tidak menemukan transaksi yang cocok.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $transaksis->links() }}
    </div>
</div>