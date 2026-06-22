<div>
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Lacak Cucian</h1>
        <p class="text-slate-500 text-sm mt-1">Lacak status cucian Anda menggunakan nomor nota atau nomor handphone secara real-time.</p>
    </div>

    <!-- Search Form -->
    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/60 p-6 shadow-sm mb-8">
        <form wire:submit.prevent="lacak" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-grow w-full">
                <label for="search" class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">Nomor Nota / Nomor HP</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        wire:model="search"
                        type="text"
                        id="search"
                        placeholder="Contoh: INV-0001 atau 0812345..."
                        class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition text-sm shadow-inner"
                    />
                </div>
                @error('search')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full md:w-auto bg-indigo-650 hover:bg-indigo-750 text-white font-bold px-6 py-3 rounded-2xl shadow-lg transition transform hover:-translate-y-0.5 active:translate-y-0 text-sm whitespace-nowrap">
                Lacak Status
            </button>
        </form>
    </div>

    <!-- Main Section: Grid of Results & Detailed Timeline -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Results Column -->
        <div class="lg:col-span-5 flex flex-col gap-4">
            @if($searched)
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/60 p-6 shadow-sm">
                    <h2 class="text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-4">Hasil Pencarian ({{ $results ? $results->count() : 0 }})</h2>
                    
                    @if($results && $results->count() > 0)
                        <div class="flex flex-col gap-3">
                            @foreach($results as $item)
                                <button
                                    wire:click="showDetail({{ $item->id }})"
                                    class="w-full text-left p-4 rounded-2xl border transition flex items-center justify-between {{ $detailTransaksi && $detailTransaksi->id === $item->id ? 'bg-indigo-50/50 border-indigo-200 dark:bg-indigo-950/20 dark:border-indigo-900' : 'bg-slate-50/50 border-slate-100 hover:bg-slate-50 dark:bg-slate-900/20 dark:border-slate-800 dark:hover:bg-slate-750/30' }}"
                                >
                                    <div>
                                        <p class="font-extrabold text-sm text-slate-900 dark:text-white">{{ $item->no_nota }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $item->paket->nama }} • {{ $item->berat }} kg</p>
                                    </div>
                                    <div class="text-right">
                                        @php
                                            $badgeColor = match($item->status) {
                                                'antrean' => 'bg-amber-50 text-amber-700 border-amber-200/50 dark:bg-amber-950/20 dark:text-amber-400 dark:border-amber-900/50',
                                                'dicuci' => 'bg-indigo-50 text-indigo-700 border-indigo-200/50 dark:bg-indigo-950/20 dark:text-indigo-400 dark:border-indigo-900/50',
                                                'disetrika' => 'bg-sky-50 text-sky-700 border-sky-200/50 dark:bg-sky-950/20 dark:text-sky-400 dark:border-sky-900/50',
                                                'siap_diambil' => 'bg-emerald-50 text-emerald-700 border-emerald-200/50 dark:bg-emerald-950/20 dark:text-emerald-400 dark:border-emerald-900/50',
                                                default => 'bg-slate-50 text-slate-700 border-slate-200/50 dark:bg-slate-950/20 dark:text-slate-400 dark:border-slate-900/50',
                                            };
                                            $statusLabel = match($item->status) {
                                                'antrean' => 'Antrean',
                                                'dicuci' => 'Dicuci',
                                                'disetrika' => 'Disetrika',
                                                'siap_diambil' => 'Siap Diambil',
                                                default => $item->status,
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $badgeColor }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Tidak ada cucian yang ditemukan.</p>
                            <p class="text-xs text-slate-400 mt-1">Periksa kembali nomor nota atau nomor HP yang Anda masukkan.</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-indigo-50/50 border border-indigo-100 dark:bg-indigo-950/10 dark:border-indigo-900/30 rounded-3xl p-6 text-center">
                    <svg class="w-12 h-12 mx-auto text-indigo-500/70 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="font-bold text-indigo-900 dark:text-indigo-400 text-sm">Pelacakan Otomatis</h3>
                    <p class="text-xs text-indigo-700 dark:text-indigo-500/80 mt-1 leading-relaxed">
                        Kami mencari transaksi secara otomatis menggunakan nomor HP yang terdaftar pada akun Anda (<strong>{{ auth()->user()->no_hp ?? '-' }}</strong>).
                    </p>
                </div>
            @endif
        </div>

        <!-- Detail & Timeline Column -->
        <div class="lg:col-span-7">
            @if($detailTransaksi)
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/60 p-6 shadow-sm flex flex-col gap-6">
                    <!-- Invoice Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-100 dark:border-slate-700/60 pb-5 gap-3">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Detail Transaksi</p>
                            <h2 class="text-xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $detailTransaksi->no_nota }}</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Dibuat pada {{ $detailTransaksi->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-xs text-slate-400">Total Biaya</span>
                            <span class="text-xl font-extrabold text-indigo-700 dark:text-indigo-400">Rp {{ number_format($detailTransaksi->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Progress Tracker (Timeline) -->
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-6">Status Pengerjaan</h3>
                        
                        @php
                            $statuses = ['antrean', 'dicuci', 'disetrika', 'siap_diambil'];
                            $currentStatusIndex = array_search($detailTransaksi->status, $statuses);
                            
                            $statusMetadata = [
                                'antrean' => [
                                    'title' => 'Dalam Antrean',
                                    'desc' => 'Pakaian telah diterima dan sedang menunggu giliran untuk dicuci.',
                                    'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                                ],
                                'dicuci' => [
                                    'title' => 'Sedang Dicuci',
                                    'desc' => 'Pakaian sedang diproses menggunakan deterjen ramah lingkungan kami.',
                                    'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>'
                                ],
                                'disetrika' => [
                                    'title' => 'Sedang Disetrika',
                                    'desc' => 'Pakaian disetrika rapi dan dilipat harum siap dibungkus.',
                                    'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>'
                                ],
                                'siap_diambil' => [
                                    'title' => 'Siap Diambil',
                                    'desc' => 'Pakaian sudah bersih, wangi, dan siap diambil di outlet WashWire.',
                                    'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>'
                                ]
                            ];
                        @endphp

                        <div class="relative pl-8 space-y-6 before:absolute before:left-3.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100 dark:before:bg-slate-700/60">
                            @foreach($statuses as $index => $stat)
                                @php
                                    $isCompleted = $index < $currentStatusIndex;
                                    $isActive = $index === $currentStatusIndex;
                                    $isFuture = $index > $currentStatusIndex;
                                    
                                    $circleClass = 'bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-600 border-slate-200 dark:border-slate-700';
                                    if ($isActive) {
                                        $circleClass = 'bg-indigo-650 text-white border-indigo-650 dark:bg-indigo-600 dark:border-indigo-600 shadow-md shadow-indigo-200 dark:shadow-none';
                                    } elseif ($isCompleted) {
                                        $circleClass = 'bg-emerald-500 text-white border-emerald-500';
                                    }
                                    
                                    $titleClass = 'text-slate-400 dark:text-slate-500';
                                    if ($isActive) {
                                        $titleClass = 'text-slate-900 dark:text-white font-extrabold';
                                    } elseif ($isCompleted) {
                                        $titleClass = 'text-slate-700 dark:text-slate-350 font-bold';
                                    }
                                    
                                    $descClass = 'text-slate-400 dark:text-slate-500';
                                    if ($isActive) {
                                        $descClass = 'text-slate-600 dark:text-slate-300 text-sm font-medium';
                                    } elseif ($isCompleted) {
                                        $descClass = 'text-slate-500 dark:text-slate-400 text-xs';
                                    }
                                @endphp

                                <div class="relative flex gap-4">
                                    <!-- Bullet indicator -->
                                    <div class="absolute -left-[35px] top-1 w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-300 {{ $circleClass }} z-10">
                                        {!! $statusMetadata[$stat]['icon'] !!}
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-grow">
                                        <h4 class="text-sm tracking-tight transition duration-200 {{ $titleClass }}">
                                            {{ $statusMetadata[$stat]['title'] }}
                                            @if($isActive)
                                                <span class="ms-2 px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-700 border border-indigo-200/50 dark:bg-indigo-950/20 dark:text-indigo-400 dark:border-indigo-900/50 animate-pulse">PROSES</span>
                                            @endif
                                        </h4>
                                        <p class="text-xs transition mt-1 leading-relaxed {{ $descClass }}">
                                            {{ $statusMetadata[$stat]['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Summary Card Details -->
                    <div class="bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-700/60 rounded-2xl p-5 mt-2">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Rincian Cucian</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-slate-500 text-xs">Nama Pelanggan</p>
                                <p class="font-semibold text-slate-800 dark:text-slate-200 mt-0.5">{{ $detailTransaksi->nama_pelanggan }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500 text-xs">Layanan Paket</p>
                                <p class="font-semibold text-slate-800 dark:text-slate-200 mt-0.5">{{ $detailTransaksi->paket->nama }}</p>
                            </div>
                            <div>
                                <p class="text-slate-500 text-xs">Berat Cucian</p>
                                <p class="font-semibold text-slate-800 dark:text-slate-200 mt-0.5">{{ $detailTransaksi->berat }} kg</p>
                            </div>
                            <div>
                                <p class="text-slate-500 text-xs">Diterima Oleh</p>
                                <p class="font-semibold text-slate-800 dark:text-slate-200 mt-0.5">{{ $detailTransaksi->kasir->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/60 p-12 text-center shadow-sm h-full flex flex-col justify-center items-center min-h-[300px]">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-500 dark:bg-indigo-950/20 dark:text-indigo-400 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-slate-800 dark:text-slate-200">Pilih Nota Untuk Melihat Detail</h3>
                    <p class="text-xs text-slate-550 dark:text-slate-450 mt-1 max-w-sm">
                        Silakan cari nota cucian Anda di form atas, kemudian pilih dari daftar hasil pencarian untuk melihat timeline pelacakan secara detail.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
