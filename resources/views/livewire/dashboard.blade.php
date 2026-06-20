<div class="space-y-8 animate-fade-in">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-gradient-to-r from-slate-900 to-indigo-950 p-6 md:p-8 rounded-3xl text-white shadow-xl shadow-slate-100 relative overflow-hidden">
        <div class="absolute -right-16 -top-16 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -left-16 -bottom-16 w-48 h-48 bg-purple-500/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10">
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                Selamat datang, <span class="bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 bg-clip-text text-transparent">{{ auth()->user()->name }}</span>! 👋
            </h1>
            <p class="text-indigo-200/80 text-sm mt-1.5 font-medium flex items-center gap-1.5">
                <svg class="w-4 h-4 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                {{ now()->translatedFormat('l, d F Y') }}
            </p>
        </div>
        
        <div class="relative z-10 flex gap-2">
            <a href="{{ route('kasir.index') }}" class="px-5 py-2.5 rounded-xl bg-white text-indigo-950 font-bold hover:bg-slate-50 transition shadow-md shadow-black/5 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
                Transaksi Baru
            </a>
        </div>
    </div>

    <!-- Summary Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Metric Card 1 -->
        <div class="group bg-white rounded-3xl border border-slate-100 p-6 shadow-sm hover:shadow-md hover:border-slate-200/80 transition duration-300 relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-125 transition duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Transaksi Hari Ini</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $totalTransaksiHariIni }}</h3>
                    <p class="text-xs text-indigo-600 font-semibold mt-1">Siklus kerja aktif</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm shadow-indigo-100/50">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Metric Card 2 -->
        <div class="group bg-white rounded-3xl border border-slate-100 p-6 shadow-sm hover:shadow-md hover:border-slate-200/80 transition duration-300 relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-125 transition duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pemasukan Hari Ini</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">Rp {{ number_format($pemasukanHariIni, 0, ',', '.') }}</h3>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">Omzet kasir hari ini</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 shadow-sm shadow-emerald-100/50">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Metric Card 3 -->
        <div class="group bg-white rounded-3xl border border-slate-100 p-6 shadow-sm hover:shadow-md hover:border-slate-200/80 transition duration-300 relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-125 transition duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Cucian Belum Diambil</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $cucianPending }}</h3>
                    <p class="text-xs text-amber-600 font-semibold mt-1">Butuh penyelesaian status</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 shadow-sm shadow-amber-100/50">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Action Shortcuts -->
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <h3 class="font-bold text-slate-800 text-base mb-4 flex items-center gap-2">
            <span class="w-1.5 h-4 bg-indigo-600 rounded-full"></span>
            Akses Cepat Fitur
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <a href="{{ route('kasir.index') }}" class="group p-4 bg-slate-50 hover:bg-indigo-600 hover:text-white rounded-2xl transition duration-200 text-center flex flex-col items-center justify-center shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                </div>
                <span class="font-bold text-xs">Transaksi Baru</span>
            </a>
            <a href="{{ route('tracking.index') }}" class="group p-4 bg-slate-50 hover:bg-indigo-600 hover:text-white rounded-2xl transition duration-200 text-center flex flex-col items-center justify-center shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" /></svg>
                </div>
                <span class="font-bold text-xs">Status Pelacakan</span>
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('paket.index') }}" class="group p-4 bg-slate-50 hover:bg-indigo-600 hover:text-white rounded-2xl transition duration-200 text-center flex flex-col items-center justify-center shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mb-3">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5" /></svg>
                    </div>
                    <span class="font-bold text-xs">Kelola Paket</span>
                </a>
            @endif
            <a href="{{ route('profile.edit') }}" class="group p-4 bg-slate-50 hover:bg-indigo-600 hover:text-white rounded-2xl transition duration-200 text-center flex flex-col items-center justify-center shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 group-hover:bg-white/20 group-hover:text-white flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <span class="font-bold text-xs">Profil Akun</span>
            </a>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-50 flex items-center justify-between">
            <h3 class="font-bold text-slate-800 text-base flex items-center gap-2">
                <span class="w-1.5 h-4 bg-indigo-600 rounded-full"></span>
                5 Transaksi Terakhir
            </h3>
            <a href="{{ route('tracking.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition flex items-center gap-1">
                Semua Transaksi
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">No. Nota</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Paket</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($transaksiTerakhir as $transaksi)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-bold text-slate-800 tracking-tight">{{ $transaksi->no_nota }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $transaksi->nama_pelanggan }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $transaksi->no_hp ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-800 font-medium">{{ $transaksi->paket->nama }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $transaksi->berat }} kg</div>
                            </td>
                            <td class="px-6 py-4 font-extrabold text-slate-900">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span @class([
                                    'px-3 py-1 rounded-full text-xs font-semibold inline-block border',
                                    'bg-amber-50 text-amber-700 border-amber-100' => $transaksi->status === 'antrean',
                                    'bg-indigo-50 text-indigo-700 border-indigo-100' => $transaksi->status === 'dicuci',
                                    'bg-orange-50 text-orange-700 border-orange-100' => $transaksi->status === 'disetrika',
                                    'bg-emerald-50 text-emerald-700 border-emerald-100' => $transaksi->status === 'siap_diambil',
                                ])>
                                    {{ str_replace('_', ' ', ucfirst($transaksi->status)) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-slate-400 font-medium">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586-3.586a2 2 0 00-2.828 0L16 12m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 10" /></svg>
                                    Belum ada transaksi hari ini.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>