<div>
    <!-- Hero Section -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-800 p-6 md:p-8 text-white shadow-xl mb-8">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.15),transparent_40%)]"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <p class="text-indigo-100 text-sm font-semibold tracking-wider uppercase mb-1">Area Pelanggan</p>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                    Halo, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-indigo-100 mt-2 max-w-xl text-sm md:text-base">
                    Selamat datang di portal pelanggan WashWire. Di sini Anda dapat melacak status cucian secara real-time berdasarkan nomor nota atau nomor handphone Anda.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('pelanggan.tracking') }}" class="inline-flex items-center gap-2 bg-white text-indigo-700 font-bold px-5 py-3 rounded-2xl shadow-lg hover:bg-indigo-50 transition transform hover:-translate-y-0.5 active:translate-y-0 text-sm">
                    <svg class="w-4 h-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Lacak Cucian Anda
                </a>
            </div>
        </div>
    </div>

    <!-- Alert HP Belum Terisi -->
    @if(!$no_hp)
        <div class="mb-8 p-5 rounded-2xl bg-amber-50 border border-amber-200/60 dark:bg-amber-950/20 dark:border-amber-900/40 flex items-start gap-4 shadow-sm animate-pulse">
            <div class="w-10 h-10 shrink-0 rounded-xl bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-amber-900 dark:text-amber-300 text-base">Nomor Handphone Belum Diisi</h3>
                <p class="text-amber-700 dark:text-amber-400 text-sm mt-1">
                    Cucian Anda tidak dapat otomatis muncul di dashboard karena nomor handphone Anda belum dikonfigurasi. Harap lengkapi nomor handphone Anda di menu profil untuk mempermudah pelacakan.
                </p>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-amber-900 dark:text-amber-300 underline hover:text-amber-850 mt-2">
                    Lengkapi Sekarang
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    @endif

    <!-- Info Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Cucian Aktif -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/60 p-6 flex items-center gap-5 shadow-sm transition hover:shadow-md">
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-900/40 dark:text-indigo-300 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Cucian Sedang Diproses</p>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $cucianAktif }}</p>
            </div>
        </div>

        <!-- Cucian Siap Diambil -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/60 p-6 flex items-center gap-5 shadow-sm transition hover:shadow-md">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-300 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Siap Diambil</p>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $siapDiambil }}</p>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/60 p-6 flex items-center gap-5 shadow-sm transition hover:shadow-md">
            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 dark:bg-purple-900/40 dark:text-purple-300 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Transaksi</p>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $totalTransaksi }}</p>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/60 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 dark:border-slate-700/60 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Riwayat Cucian Anda</h2>
                <p class="text-xs text-slate-500 mt-0.5">Menampilkan seluruh riwayat cucian berdasarkan nomor handphone Anda</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 dark:bg-slate-700/20 text-slate-500 dark:text-slate-400 text-xs font-semibold uppercase tracking-wider">
                        <th class="py-4 px-6">No. Nota</th>
                        <th class="py-4 px-6">Paket</th>
                        <th class="py-4 px-6">Berat (Kg)</th>
                        <th class="py-4 px-6">Total Harga</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 text-sm">
                    @forelse($transaksis as $transaksi)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/10 transition">
                            <td class="py-4 px-6 font-semibold text-slate-900 dark:text-white">
                                {{ $transaksi->no_nota }}
                            </td>
                            <td class="py-4 px-6 text-slate-600 dark:text-slate-300">
                                {{ $transaksi->paket->nama }}
                            </td>
                            <td class="py-4 px-6 text-slate-600 dark:text-slate-300 font-medium">
                                {{ number_format($transaksi->berat, 1) }} kg
                            </td>
                            <td class="py-4 px-6 text-slate-900 dark:text-white font-bold">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                @php
                                    $badgeColor = match($transaksi->status) {
                                        'antrean' => 'bg-amber-50 text-amber-700 border-amber-200/50 dark:bg-amber-950/20 dark:text-amber-400 dark:border-amber-900/50',
                                        'dicuci' => 'bg-indigo-50 text-indigo-700 border-indigo-200/50 dark:bg-indigo-950/20 dark:text-indigo-400 dark:border-indigo-900/50',
                                        'disetrika' => 'bg-sky-50 text-sky-700 border-sky-200/50 dark:bg-sky-950/20 dark:text-sky-400 dark:border-sky-900/50',
                                        'siap_diambil' => 'bg-emerald-50 text-emerald-700 border-emerald-200/50 dark:bg-emerald-950/20 dark:text-emerald-400 dark:border-emerald-900/50',
                                        default => 'bg-slate-50 text-slate-700 border-slate-200/50 dark:bg-slate-950/20 dark:text-slate-400 dark:border-slate-900/50',
                                    };
                                    $statusLabel = match($transaksi->status) {
                                        'antrean' => 'Antrean',
                                        'dicuci' => 'Sedang Dicuci',
                                        'disetrika' => 'Sedang Disetrika',
                                        'siap_diambil' => 'Siap Diambil',
                                        default => str_replace('_', ' ', $transaksi->status),
                                    };
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeColor }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('pelanggan.tracking') }}?search={{ $transaksi->no_nota }}" class="inline-flex items-center gap-1 text-indigo-650 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 font-semibold text-xs">
                                    Detail Lacak
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="w-16 h-16 mx-auto rounded-2xl bg-slate-50 text-slate-400 dark:bg-slate-700/20 dark:text-slate-500 flex items-center justify-center mb-3">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200">Belum Ada Riwayat Cucian</h3>
                                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                                    {{ $no_hp ? 'Cucian Anda akan otomatis tampil di sini saat kasir menginput transaksi dengan nomor HP Anda.' : 'Silakan lengkapi nomor HP Anda di profil agar riwayat cucian terhubung secara otomatis.' }}
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
