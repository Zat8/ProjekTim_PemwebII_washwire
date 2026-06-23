<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-50">
                Selamat datang, {{ auth()->user()->name }}
            </h1>
            <p class="mt-1 flex items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>
        <a href="{{ route('kasir.index') }}" class="inline-flex items-center justify-center gap-2 rounded-md bg-[#9737e3] px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-[#7e2dc4] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#9737e3]/50 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-zinc-950">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Transaksi Baru
        </a>
    </div>

    <!-- Metrics -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        <!-- Metric 1 -->
        <div class="rounded-lg border border-zinc-200 bg-white p-5 transition-colors hover:border-zinc-300 dark:border-zinc-800 dark:bg-zinc-950 dark:hover:border-zinc-700">
            <div class="flex items-start justify-between">
                <div class="space-y-1">
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Transaksi Hari Ini</p>
                    <p class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-50">{{ $totalTransaksiHariIni }}</p>
                </div>
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-[#9737e3]/10">
                    <svg class="h-4 w-4 text-[#9737e3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-zinc-400 dark:text-zinc-500">Siklus kerja aktif</p>
        </div>

        <!-- Metric 2 -->
        <div class="rounded-lg border border-zinc-200 bg-white p-5 transition-colors hover:border-zinc-300 dark:border-zinc-800 dark:bg-zinc-950 dark:hover:border-zinc-700">
            <div class="flex items-start justify-between">
                <div class="space-y-1">
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Pemasukan Hari Ini</p>
                    <p class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-50">Rp {{ number_format($pemasukanHariIni, 0, ',', '.') }}</p>
                </div>
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-[#9737e3]/10">
                    <svg class="h-4 w-4 text-[#9737e3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-zinc-400 dark:text-zinc-500">Omzet kasir hari ini</p>
        </div>

        <!-- Metric 3 -->
        <div class="rounded-lg border border-zinc-200 bg-white p-5 transition-colors hover:border-zinc-300 dark:border-zinc-800 dark:bg-zinc-950 dark:hover:border-zinc-700">
            <div class="flex items-start justify-between">
                <div class="space-y-1">
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Cucian Belum Diambil</p>
                    <p class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-50">{{ $cucianPending }}</p>
                </div>
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-[#9737e3]/10">
                    <svg class="h-4 w-4 text-[#9737e3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="mt-3 text-sm text-zinc-400 dark:text-zinc-500">Butuh penyelesaian status</p>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="rounded-lg border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
        <div class="border-b border-zinc-100 px-5 py-4 dark:border-zinc-800">
            <h3 class="flex items-center gap-2 text-sm font-medium text-zinc-900 dark:text-zinc-50">
                <span class="h-4 w-1 rounded-full bg-[#9737e3]"></span>
                Akses Cepat
            </h3>
        </div>
        <div class="grid grid-cols-2 gap-px bg-zinc-100 sm:grid-cols-4 dark:bg-zinc-800">
            <a href="{{ route('kasir.index') }}" class="group flex flex-col items-center gap-3 bg-white px-4 py-6 text-center transition-colors hover:bg-zinc-50 dark:bg-zinc-950 dark:hover:bg-zinc-900">
                <div class="flex h-10 w-10 items-center justify-center rounded-md bg-[#9737e3]/10 text-[#9737e3] transition-colors group-hover:bg-[#9737e3] group-hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Transaksi Baru</span>
            </a>
            <a href="{{ route('tracking.index') }}" class="group flex flex-col items-center gap-3 bg-white px-4 py-6 text-center transition-colors hover:bg-zinc-50 dark:bg-zinc-950 dark:hover:bg-zinc-900">
                <div class="flex h-10 w-10 items-center justify-center rounded-md bg-[#9737e3]/10 text-[#9737e3] transition-colors group-hover:bg-[#9737e3] group-hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Status Pelacakan</span>
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('paket.index') }}" class="group flex flex-col items-center gap-3 bg-white px-4 py-6 text-center transition-colors hover:bg-zinc-50 dark:bg-zinc-950 dark:hover:bg-zinc-900">
                    <div class="flex h-10 w-10 items-center justify-center rounded-md bg-[#9737e3]/10 text-[#9737e3] transition-colors group-hover:bg-[#9737e3] group-hover:text-white">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Kelola Paket</span>
                </a>
            @endif
            <a href="{{ route('profile.edit') }}" class="group flex flex-col items-center gap-3 bg-white px-4 py-6 text-center transition-colors hover:bg-zinc-50 dark:bg-zinc-950 dark:hover:bg-zinc-900">
                <div class="flex h-10 w-10 items-center justify-center rounded-md bg-[#9737e3]/10 text-[#9737e3] transition-colors group-hover:bg-[#9737e3] group-hover:text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Profil Akun</span>
            </a>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="rounded-lg border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-950">
        <div class="flex items-center justify-between border-b border-zinc-100 px-5 py-4 dark:border-zinc-800">
            <h3 class="flex items-center gap-2 text-sm font-medium text-zinc-900 dark:text-zinc-50">
                <span class="h-4 w-1 rounded-full bg-[#9737e3]"></span>
                5 Transaksi Terakhir
            </h3>
            <a href="{{ route('tracking.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-[#9737e3] transition-colors hover:text-[#7e2dc4]">
                Lihat Semua
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-zinc-100 dark:border-zinc-800">
                        <th class="px-5 py-3 text-left text-sm font-medium text-zinc-500 dark:text-zinc-400">No. Nota</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-zinc-500 dark:text-zinc-400">Pelanggan</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-zinc-500 dark:text-zinc-400">Paket</th>
                        <th class="px-5 py-3 text-left text-sm font-medium text-zinc-500 dark:text-zinc-400">Total</th>
                        <th class="px-5 py-3 text-center text-sm font-medium text-zinc-500 dark:text-zinc-400">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksiTerakhir as $transaksi)
                        <tr class="border-b border-zinc-50 transition-colors hover:bg-zinc-50/50 last:border-b-0 dark:border-zinc-800/50 dark:hover:bg-zinc-900/50">
                            <td class="px-5 py-3.5 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $transaksi->no_nota }}</td>
                            <td class="px-5 py-3.5">
                                <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $transaksi->nama_pelanggan }}</p>
                                <p class="text-sm text-zinc-400 dark:text-zinc-500">{{ $transaksi->no_hp ?? '-' }}</p>
                            </td>
                            <td class="px-5 py-3.5">
                                <p class="text-sm text-zinc-900 dark:text-zinc-100">{{ $transaksi->paket->nama }}</p>
                                <p class="text-sm text-zinc-400 dark:text-zinc-500">{{ $transaksi->berat }} kg</p>
                            </td>
                            <td class="px-5 py-3.5 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                <span @class([
                                    'inline-flex items-center gap-1.5 rounded-md px-2.5 py-1 text-sm font-medium',
                                    'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400' => $transaksi->status === 'antrean',
                                    'bg-[#9737e3]/10 text-[#9737e3] dark:bg-[#9737e3]/15 dark:text-[#b875f0]' => $transaksi->status === 'dicuci',
                                    'bg-orange-50 text-orange-700 dark:bg-orange-950/40 dark:text-orange-400' => $transaksi->status === 'disetrika',
                                    'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400' => $transaksi->status === 'siap_diambil',
                                ])>
                                    <span @class([
                                        'h-1.5 w-1.5 rounded-full',
                                        'bg-amber-500' => $transaksi->status === 'antrean',
                                        'bg-[#9737e3]' => $transaksi->status === 'dicuci',
                                        'bg-orange-500' => $transaksi->status === 'disetrika',
                                        'bg-emerald-500' => $transaksi->status === 'siap_diambil',
                                    ])></span>
                                    {{ str_replace('_', ' ', ucfirst($transaksi->status)) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-zinc-400 dark:text-zinc-500">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586-3.586a2 2 0 00-2.828 0L16 12m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 10" />
                                    </svg>
                                    <p class="text-sm">Belum ada transaksi hari ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
