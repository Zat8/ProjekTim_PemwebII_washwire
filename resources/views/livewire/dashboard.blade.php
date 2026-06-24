<div class="space-y-6">
    <!-- Header Section -->
    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-canvas dark:bg-ink p-8 border-b border-hairline dark:border-stone">
        <div>
            <h1 class="text-[32px] font-bold tracking-tight uppercase text-ink dark:text-canvas">
                Selamat datang, {{ auth()->user()->name }}
            </h1>
            <p class="text-sm font-medium tracking-widest uppercase text-mute dark:text-stone mt-2 flex items-center gap-2">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('kasir.index') }}"
                class="px-6 py-3 rounded-full bg-ink dark:bg-canvas hover:opacity-80 text-canvas dark:text-ink font-medium text-sm transition-opacity flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Transaksi Baru
            </a>
        </div>
    </div>

    <!-- Summary Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4 sm:px-0">
        <!-- Metric Card 1 -->
        <div class="bg-canvas dark:bg-ink border border-hairline dark:border-stone p-6 rounded-none">
            <div class="flex items-center justify-between">
                <p class="text-xs font-bold uppercase tracking-widest text-mute dark:text-stone">Total Transaksi Hari Ini</p>
            </div>
            <h3 class="font-display text-[48px] leading-[1] text-ink dark:text-canvas mt-4">
                {{ $totalTransaksiHariIni }}
            </h3>
            <p class="text-sm text-charcoal dark:text-stone mt-2">Siklus kerja aktif</p>
        </div>

        <!-- Metric Card 2 -->
        <div class="bg-canvas dark:bg-ink border border-hairline dark:border-stone p-6 rounded-none">
            <div class="flex items-center justify-between">
                <p class="text-xs font-bold uppercase tracking-widest text-mute dark:text-stone">Pemasukan Hari Ini</p>
            </div>
            <h3 class="font-display text-[48px] leading-[1] text-ink dark:text-canvas mt-4">
                Rp {{ number_format($pemasukanHariIni, 0, ',', '.') }}
            </h3>
            <p class="text-sm text-charcoal dark:text-stone mt-2">Omzet kasir hari ini</p>
        </div>

        <!-- Metric Card 3 -->
        <div class="bg-canvas dark:bg-ink border border-hairline dark:border-stone p-6 rounded-none">
            <div class="flex items-center justify-between">
                <p class="text-xs font-bold uppercase tracking-widest text-mute dark:text-stone">Cucian Belum Diambil</p>
            </div>
            <h3 class="font-display text-[48px] leading-[1] text-ink dark:text-canvas mt-4">
                {{ $cucianPending }}
            </h3>
            <p class="text-sm text-charcoal dark:text-stone mt-2">Butuh penyelesaian status</p>
        </div>
    </div>

    <!-- Quick Action Shortcuts -->
    <div class="bg-canvas dark:bg-ink border border-hairline dark:border-stone p-6 mx-4 sm:mx-0 rounded-none">
        <h3 class="text-sm font-bold uppercase tracking-widest text-ink dark:text-canvas mb-6">Akses Cepat</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('kasir.index') }}"
                class="group p-6 bg-soft-cloud dark:bg-charcoal hover:bg-hairline-soft dark:hover:bg-ash rounded-none transition-colors text-center flex flex-col items-center border border-hairline dark:border-stone">
                <div class="w-12 h-12 rounded-full bg-canvas dark:bg-ink text-ink dark:text-canvas flex items-center justify-center mb-4 border border-ink dark:border-canvas">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="font-bold text-sm tracking-tight text-ink dark:text-canvas uppercase">Transaksi Baru</span>
            </a>

            <a href="{{ route('tracking.index') }}"
                class="group p-6 bg-soft-cloud dark:bg-charcoal hover:bg-hairline-soft dark:hover:bg-ash rounded-none transition-colors text-center flex flex-col items-center border border-hairline dark:border-stone">
                <div class="w-12 h-12 rounded-full bg-canvas dark:bg-ink text-ink dark:text-canvas flex items-center justify-center mb-4 border border-ink dark:border-canvas">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                    </svg>
                </div>
                <span class="font-bold text-sm tracking-tight text-ink dark:text-canvas uppercase">Status Pelacakan</span>
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('paket.index') }}"
                    class="group p-6 bg-soft-cloud dark:bg-charcoal hover:bg-hairline-soft dark:hover:bg-ash rounded-none transition-colors text-center flex flex-col items-center border border-hairline dark:border-stone">
                    <div class="w-12 h-12 rounded-full bg-canvas dark:bg-ink text-ink dark:text-canvas flex items-center justify-center mb-4 border border-ink dark:border-canvas">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5" />
                        </svg>
                    </div>
                    <span class="font-bold text-sm tracking-tight text-ink dark:text-canvas uppercase">Kelola Paket</span>
                </a>
            @endif

            <a href="{{ route('profile.edit') }}"
                class="group p-6 bg-soft-cloud dark:bg-charcoal hover:bg-hairline-soft dark:hover:bg-ash rounded-none transition-colors text-center flex flex-col items-center border border-hairline dark:border-stone">
                <div class="w-12 h-12 rounded-full bg-canvas dark:bg-ink text-ink dark:text-canvas flex items-center justify-center mb-4 border border-ink dark:border-canvas">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="font-bold text-sm tracking-tight text-ink dark:text-canvas uppercase">Profil Akun</span>
            </a>
        </div>
    </div>

    <!-- Recent Transactions Tables -->
    <div class="flex flex-col xl:flex-row items-start gap-6 w-full px-4 sm:px-0">
        <!-- table 1 -->
        <div class="w-full xl:w-2/5 bg-canvas dark:bg-ink border border-hairline dark:border-stone rounded-none">
            <div class="px-6 py-4 border-b border-hairline dark:border-stone">
                <h3 class="text-sm font-bold uppercase tracking-widest text-ink dark:text-canvas">Cucian Selesai Hari Ini ({{$totalTransaksiSelesaiHariIni}})</h3>
            </div>
            <div class="overflow-y-auto max-h-[360px]">
                <table class="w-full text-sm text-left">
                    <thead class="bg-soft-cloud dark:bg-charcoal border-b border-hairline dark:border-stone sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-ink dark:text-canvas">Waktu</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-ink dark:text-canvas">Paket</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-ink dark:text-canvas text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-hairline dark:divide-stone">
                        @forelse ($transaksiSelesaiHariIni as $transaksi)
                            <tr class="hover:bg-soft-cloud dark:hover:bg-charcoal transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-ink dark:text-canvas">
                                        {{ $transaksi->created_at->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-ink dark:text-canvas">{{ $transaksi->paket->nama }} ({{ $transaksi->berat }} kg)</div>
                                </td>
                                <td class="px-6 py-4 font-bold text-ink dark:text-canvas text-right">
                                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-12 text-mute dark:text-stone">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <p class="text-sm font-medium uppercase tracking-widest">Belum ada transaksi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-hairline dark:border-stone flex justify-between bg-soft-cloud dark:bg-charcoal px-6 py-4">
                <div class="font-bold text-ink dark:text-canvas uppercase tracking-widest text-sm">Total</div>
                <div class="font-bold text-ink dark:text-canvas text-sm">Rp {{ number_format($transaksiSelesaiHariIni->sum('total_harga'), 0, ',', '.') }}</div>
            </div>
        </div>


        <!-- table 2 -->
        <div class="w-full xl:w-3/5 bg-canvas dark:bg-ink border border-hairline dark:border-stone rounded-none">
            <div class="px-6 py-4 border-b border-hairline dark:border-stone flex items-center justify-between">
                <h3 class="text-sm font-bold uppercase tracking-widest text-ink dark:text-canvas">5 Transaksi Terbaru</h3>
                <a href="{{ route('tracking.index') }}"
                    class="text-xs font-bold uppercase tracking-widest text-ink hover:text-charcoal dark:text-canvas dark:hover:text-stone transition-colors flex items-center gap-2 border-b border-ink dark:border-canvas pb-0.5">
                    Lihat Semua
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-soft-cloud dark:bg-charcoal border-b border-hairline dark:border-stone">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-ink dark:text-canvas">No. Nota</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-ink dark:text-canvas">Pelanggan</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-ink dark:text-canvas">Paket</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-ink dark:text-canvas text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-hairline dark:divide-stone">
                        @forelse ($transaksiTerakhir as $transaksi)
                            <tr class="hover:bg-soft-cloud dark:hover:bg-charcoal transition-colors">
                                <td class="px-6 py-4">
                                    <a href="{{ route('tracking.index', ['search' => $transaksi->no_nota]) }}"
                                        class="underline font-bold text-ink dark:text-canvas">
                                        {{ $transaksi->no_nota }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('tracking.index', ['search' => $transaksi->nama_pelanggan]) }}"
                                        class="font-bold text-ink dark:text-canvas">
                                        {{ $transaksi->nama_pelanggan }}
                                    </a>
                                    <div class="text-xs text-mute dark:text-stone mt-1 uppercase tracking-widest">
                                        {{ $transaksi->no_hp ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-ink dark:text-canvas">{{ $transaksi->paket->nama }}</div>
                                    <div class="text-xs text-mute dark:text-stone mt-1">{{ $transaksi->berat }} kg</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span @class([
                                        'px-3 py-1 rounded-none text-[10px] font-bold uppercase tracking-widest inline-flex items-center border',
                                        'bg-canvas text-ink border-ink dark:bg-ink dark:text-canvas dark:border-canvas' => $transaksi->status === 'antrean',
                                        'bg-ink text-canvas border-ink dark:bg-canvas dark:text-ink dark:border-canvas' => $transaksi->status === 'dicuci',
                                        'bg-soft-cloud text-ink border-hairline dark:bg-charcoal dark:text-canvas dark:border-stone' => $transaksi->status === 'disetrika',
                                        'bg-success text-canvas border-success dark:bg-success-bright dark:border-success-bright' => $transaksi->status === 'siap_diambil',
                                    ])>
                                        {{ str_replace('_', ' ', $transaksi->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-12 text-mute dark:text-stone">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <p class="text-sm font-medium uppercase tracking-widest">Belum ada transaksi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>