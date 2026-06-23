<div class="space-y-6">
    <!-- Header Section -->
    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-800">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-50">
                Selamat datang, {{ auth()->user()->name }}
            </h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('kasir.index') }}"
                class="px-4 py-2 rounded-md bg-[#9737e3] hover:bg-[#8528d1] text-white font-medium text-sm shadow-sm transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Transaksi Baru
            </a>
        </div>
    </div>

    <!-- Summary Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Metric Card 1 -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Transaksi Hari Ini</p>
                <div
                    class="w-9 h-9 rounded-md bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-600 dark:text-zinc-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-50 mt-3">
                {{ $totalTransaksiHariIni }}
            </h3>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Siklus kerja aktif</p>
        </div>

        <!-- Metric Card 2 -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Pemasukan Hari Ini</p>
                <div
                    class="w-9 h-9 rounded-md bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-600 dark:text-zinc-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-50 mt-3">Rp
                {{ number_format($pemasukanHariIni, 0, ',', '.') }}
            </h3>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Omzet kasir hari ini</p>
        </div>

        <!-- Metric Card 3 -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Cucian Belum Diambil</p>
                <div
                    class="w-9 h-9 rounded-md bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-600 dark:text-zinc-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-50 mt-3">{{ $cucianPending }}
            </h3>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Butuh penyelesaian status</p>
        </div>
    </div>

    <!-- Quick Action Shortcuts -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
        <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-50 mb-4">Akses Cepat</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <a href="{{ route('kasir.index') }}"
                class="group p-4 bg-zinc-50 dark:bg-zinc-800/50 hover:bg-[#9737e3]/5 hover:border-[#9737e3]/30 border border-transparent rounded-lg transition-colors text-center flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-md bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 text-[#9737e3] flex items-center justify-center mb-3 shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="font-medium text-sm text-zinc-700 dark:text-zinc-300">Transaksi Baru</span>
            </a>

            <a href="{{ route('tracking.index') }}"
                class="group p-4 bg-zinc-50 dark:bg-zinc-800/50 hover:bg-[#9737e3]/5 hover:border-[#9737e3]/30 border border-transparent rounded-lg transition-colors text-center flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-md bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 text-[#9737e3] flex items-center justify-center mb-3 shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                    </svg>
                </div>
                <span class="font-medium text-sm text-zinc-700 dark:text-zinc-300">Status Pelacakan</span>
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('paket.index') }}"
                    class="group p-4 bg-zinc-50 dark:bg-zinc-800/50 hover:bg-[#9737e3]/5 hover:border-[#9737e3]/30 border border-transparent rounded-lg transition-colors text-center flex flex-col items-center">
                    <div
                        class="w-10 h-10 rounded-md bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 text-[#9737e3] flex items-center justify-center mb-3 shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5" />
                        </svg>
                    </div>
                    <span class="font-medium text-sm text-zinc-700 dark:text-zinc-300">Kelola Paket</span>
                </a>
            @endif

            <a href="{{ route('profile.edit') }}"
                class="group p-4 bg-zinc-50 dark:bg-zinc-800/50 hover:bg-[#9737e3]/5 hover:border-[#9737e3]/30 border border-transparent rounded-lg transition-colors text-center flex flex-col items-center">
                <div
                    class="w-10 h-10 rounded-md bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 text-[#9737e3] flex items-center justify-center mb-3 shadow-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="font-medium text-sm text-zinc-700 dark:text-zinc-300">Profil Akun</span>
            </a>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="flex items-start gap-6 overflow-hidden w-full">
        <!-- table 1 -->
        <div class="w-3/5 h-fit bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800">
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-50">Cucian Selesai Hari Ini ({{$totalTransaksiSelesaiHariIni}})</h3>
            </div>
            <div class="overflow-y-auto max-h-[360px]">
                <table class="w-full text-sm text-left relative">
                    <thead class="bg-zinc-50 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-800 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Waktu</th>
                            <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Paket</th>
                            <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse ($transaksiSelesaiHariIni as $transaksi)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $transaksi->created_at->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-zinc-900 dark:text-zinc-100">{{ $transaksi->paket->nama }} ({{ $transaksi->berat }} kg)</div>
                                   
                                </td>
                                <td class="px-6 py-4 font-semibold text-zinc-900 dark:text-zinc-100">
                                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-zinc-500 dark:text-zinc-400">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div
                                            class="w-12 h-12 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-zinc-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586-3.586a2 2 0 00-2.828 0L16 12m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 10" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium">Belum ada transaksi hari ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-zinc-200 dark:border-zinc-800 flex flex-row justify-between w-full">
                <div class="px-6 py-4 w-full font-semibold text-purple-600 dark:text-purple-600 text-left">
                    Total </div>
                <div class="pr-12 py-4 font-semibold text-purple-600 dark:text-purple-600">Rp{{ number_format($transaksiSelesaiHariIni->sum('total_harga'), 0, ',', '.') }}</div>
            </div>
        </div>


        <!-- table 2 -->
        <div class="w-full h-fit bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800">
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-50">5 Transaksi Terbaru</h3>
                <a href="{{ route('tracking.index') }}"
                    class="text-sm font-medium text-[#9737e3] hover:text-[#8528d1] transition-colors flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">No. Nota</th>
                            <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Pelanggan</th>
                            <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Paket</th>
                            <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse ($transaksiTerakhir as $transaksi)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <a href="{{ route('tracking.index', ['search' => $transaksi->no_nota]) }}"
                                        class="underline cursor-pointer font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $transaksi->no_nota }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('tracking.index', ['search' => $transaksi->nama_pelanggan]) }}"
                                        class="font-medium cursor-pointer text-purple-600 dark:text-zinc-100">
                                        {{ $transaksi->nama_pelanggan }}
                                    </a>
                                    <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">
                                        {{ $transaksi->no_hp ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-zinc-900 dark:text-zinc-100">{{ $transaksi->paket->nama }}</div>
                                    <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">{{ $transaksi->berat }} kg
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span @class([
                                        'px-2.5 py-0.5 rounded-md text-xs font-medium inline-flex items-center border',
                                        'bg-zinc-100 text-zinc-800 border-zinc-200 dark:bg-zinc-700 dark:text-zinc-200 dark:border-zinc-600' => $transaksi->status === 'antrean',
                                        'bg-[#9737e3]/10 text-[#9737e3] border-[#9737e3]/20' => $transaksi->status === 'dicuci',
                                        'bg-transparent text-zinc-600 border-zinc-300 dark:text-zinc-400 dark:border-zinc-700' => $transaksi->status === 'disetrika',
                                        'bg-zinc-900 text-zinc-50 border-zinc-900 dark:bg-zinc-50 dark:text-zinc-900 dark:border-zinc-50' => $transaksi->status === 'siap_diambil',
                                    ])>
                                        {{ str_replace('_', ' ', ucfirst($transaksi->status)) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-zinc-500 dark:text-zinc-400">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div
                                            class="w-12 h-12 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-zinc-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586-3.586a2 2 0 00-2.828 0L16 12m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 10" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium">Belum ada transaksi hari ini.</p>
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