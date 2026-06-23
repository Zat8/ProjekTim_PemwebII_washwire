<div class="space-y-6">
    {{-- Hero Section --}}
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6 md:p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-1">Area Pelanggan</p>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight">
                    Halo, {{ auth()->user()->name }}
                </h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-2 max-w-xl">
                    Selamat datang di portal pelanggan WashWire. Lacak status cucian Anda secara real-time menggunakan nomor nota atau nomor handphone yang terdaftar.
                </p>
            </div>
            <div>
                <a href="{{ route('pelanggan.tracking') }}" class="inline-flex items-center gap-2 rounded-md bg-[#b45ef7] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#a04de0] transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Lacak Cucian Anda
                </a>
            </div>
        </div>
    </div>

    {{-- Alert HP Belum Terisi --}}
    @if(!$no_hp)
        <div class="rounded-lg border border-amber-200 bg-amber-50 p-4 text-amber-800 dark:border-amber-900/50 dark:bg-amber-950/50 dark:text-amber-300 flex items-start gap-3">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <h3 class="text-sm font-semibold">Nomor Handphone Belum Diisi</h3>
                <p class="text-sm mt-1 opacity-90">
                    Riwayat cucian tidak akan otomatis terhubung karena nomor handphone belum dikonfigurasi. Silakan lengkapi data Anda di menu profil.
                </p>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1 text-sm font-medium underline hover:text-amber-900 dark:hover:text-amber-200 mt-2 transition-colors">
                    Lengkapi Sekarang
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </div>
    @endif

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Cucian Aktif -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Sedang Diproses</p>
                    <p class="text-3xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight mt-0.5">{{ $cucianAktif }}</p>
                </div>
            </div>
        </div>

        <!-- Cucian Siap Diambil -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Siap Diambil</p>
                    <p class="text-3xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight mt-0.5">{{ $siapDiambil }}</p>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Transaksi</p>
                    <p class="text-3xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight mt-0.5">{{ $totalTransaksi }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Riwayat Transaksi --}}
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="p-6 border-b border-zinc-200 dark:border-zinc-800">
            <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-50">Riwayat Cucian Anda</h2>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">Menampilkan seluruh riwayat cucian berdasarkan nomor handphone Anda</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                    <tr>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">No. Nota</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Paket</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Berat</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Total Harga</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400 text-center">Status</th>
                        <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($transaksis as $transaksi)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-100">
                                {{ $transaksi->no_nota }}
                            </td>
                            <td class="px-6 py-4 text-zinc-700 dark:text-zinc-300">
                                {{ $transaksi->paket->nama }}
                            </td>
                            <td class="px-6 py-4 text-zinc-700 dark:text-zinc-300 font-medium">
                                {{ number_format($transaksi->berat, 1) }} kg
                            </td>
                            <td class="px-6 py-4 font-semibold text-zinc-900 dark:text-zinc-100">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $badgeClass = match($transaksi->status) {
                                        'antrean' => 'border-zinc-200 bg-zinc-100 text-zinc-800 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                                        'dicuci'  => 'border-[#b45ef7]/20 bg-[#b45ef7]/10 text-[#b45ef7] dark:border-[#b45ef7]/30 dark:bg-[#b45ef7]/20',
                                        'disetrika' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/50 dark:text-amber-300',
                                        'siap_diambil' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/50 dark:text-emerald-300',
                                        default => 'border-zinc-200 bg-zinc-50 text-zinc-600 dark:border-zinc-700 dark:bg-zinc-800/50 dark:text-zinc-400',
                                    };
                                    $statusLabel = match($transaksi->status) {
                                        'antrean' => 'Antrean',
                                        'dicuci' => 'Sedang Dicuci',
                                        'disetrika' => 'Sedang Disetrika',
                                        'siap_diambil' => 'Siap Diambil',
                                        default => str_replace('_', ' ', ucfirst($transaksi->status)),
                                    };
                                @endphp
                                <span class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold {{ $badgeClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('pelanggan.tracking') }}?search={{ $transaksi->no_nota }}" class="inline-flex items-center justify-end gap-1 text-sm font-medium text-[#b45ef7] hover:text-[#933bd6] transition-colors">
                                    Detail Lacak
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-zinc-500 dark:text-zinc-400">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                    </div>
                                    <p class="text-sm font-medium">Belum Ada Riwayat Cucian</p>
                                    <p class="text-sm max-w-xs text-center">
                                        {{ $no_hp ? 'Cucian Anda akan otomatis tampil di sini saat kasir menginput transaksi.' : 'Lengkapi nomor HP di profil agar riwayat terhubung.' }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
