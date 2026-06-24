<div class="space-y-6">
    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight">Lacak Cucian</h1>
        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Lacak status cucian Anda menggunakan nomor nota atau nomor handphone secara real-time.</p>
    </div>

    {{-- Search Form --}}
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
        <form wire:submit.prevent="lacak" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-grow w-full space-y-2">
                <label for="search" class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Nomor Nota / Nomor HP</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        wire:model="search"
                        type="text"
                        id="search"
                        placeholder="Contoh: INV-0001 atau 0812345..."
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white pl-9 pr-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 transition-colors"
                    />
                </div>
                @error('search')
                    <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-[#b45ef7] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#a04de0] focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/40 focus:ring-offset-2 transition-colors w-full md:w-auto h-10">
                Lacak Status
            </button>
        </form>
    </div>

    {{-- Main Section: Grid of Results & Detailed Timeline --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- Results Column --}}
        <div class="lg:col-span-5 flex flex-col gap-4">
            @if($searched)
                <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6">
                    <h2 class="text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-4">
                        Hasil Pencarian <span class="text-zinc-900 dark:text-zinc-50">({{ $results ? $results->count() : 0 }})</span>
                    </h2>

                    @if($results && $results->count() > 0)
                        <div class="flex flex-col gap-2">
                            @foreach($results as $item)
                                <button
                                    wire:click="showDetail({{ $item->id }})"
                                    @class([
                                        'w-full text-left p-4 rounded-md border transition-colors flex items-center justify-between',
                                        'bg-[#b45ef7]/5 border-[#b45ef7]/30 dark:bg-[#b45ef7]/10' => $detailTransaksi && $detailTransaksi->id === $item->id,
                                        'bg-white hover:bg-zinc-50 border-zinc-200 dark:bg-zinc-900 dark:hover:bg-zinc-800/50 dark:border-zinc-800' => !$detailTransaksi || $detailTransaksi->id !== $item->id,
                                    ])
                                >
                                    <div>
                                        <p class="font-semibold text-sm text-zinc-900 dark:text-zinc-50">{{ $item->no_nota }}</p>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">{{ $item->paket->nama }} • {{ $item->berat }} kg</p>
                                    </div>
                                    <div class="text-right">
                                        @php
                                            $badgeColor = match($item->status) {
                                                'antrean' => 'border-zinc-200 bg-zinc-100 text-zinc-800 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                                                'dicuci' => 'border-[#b45ef7]/20 bg-[#b45ef7]/10 text-[#b45ef7] dark:border-[#b45ef7]/30 dark:bg-[#b45ef7]/20',
                                                'disetrika' => 'border-amber-200 bg-amber-50 text-amber-700 dark:border-amber-900/50 dark:bg-amber-950/50 dark:text-amber-300',
                                                'siap_diambil' => 'border-emerald-200 bg-emerald-50 text-emerald-700 dark:border-emerald-900/50 dark:bg-emerald-950/50 dark:text-emerald-300',
                                                default => 'border-zinc-200 bg-zinc-50 text-zinc-600 dark:border-zinc-700 dark:bg-zinc-800/50 dark:text-zinc-400',
                                            };
                                            $statusLabel = match($item->status) {
                                                'antrean' => 'Antrean',
                                                'dicuci' => 'Dicuci',
                                                'disetrika' => 'Disetrika',
                                                'siap_diambil' => 'Siap Diambil',
                                                default => str_replace('_', ' ', ucfirst($item->status)),
                                            };
                                        @endphp
                                        <span class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold {{ $badgeColor }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="w-12 h-12 mx-auto rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Tidak ada cucian yang ditemukan.</p>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Periksa kembali nomor nota atau nomor HP yang Anda masukkan.</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-zinc-50 dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800 rounded-lg p-6 text-center">
                    <div class="w-12 h-12 mx-auto rounded-full bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-[#b45ef7]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-50">Pelacakan Otomatis</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                        Kami mencari transaksi secara otomatis menggunakan nomor HP yang terdaftar pada akun Anda (<strong class="text-zinc-700 dark:text-zinc-300">{{ auth()->user()->no_hp ?? '-' }}</strong>).
                    </p>
                </div>
            @endif
        </div>

        {{-- Detail & Timeline Column --}}
        <div class="lg:col-span-7">
            @if($detailTransaksi)
                <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-6 flex flex-col gap-6">
                    {{-- Invoice Header --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-zinc-200 dark:border-zinc-800 pb-5 gap-3">
                        <div>
                            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Detail Transaksi</p>
                            <h2 class="text-xl font-semibold text-zinc-900 dark:text-zinc-50 mt-1 tracking-tight">{{ $detailTransaksi->no_nota }}</h2>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">Dibuat pada {{ $detailTransaksi->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm text-zinc-500 dark:text-zinc-400">Total Biaya</span>
                            <span class="text-xl font-semibold text-[#b45ef7] dark:text-[#b45ef7]">Rp {{ number_format($detailTransaksi->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Progress Tracker (Timeline) --}}
                    <div>
                        <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-50 mb-6">Status Pengerjaan</h3>

                        @php
                            $statuses = $detailTransaksi->statusUrutan();
                            $currentStatusIndex = array_search($detailTransaksi->status, $statuses);

                            $statusMetadata = [
                                'antrean' => [
                                    'title' => 'Dalam Antrean',
                                    'desc' => 'Pakaian telah diterima dan sedang menunggu giliran untuk dicuci.',
                                    'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                                ],
                                'dicuci' => [
                                    'title' => 'Sedang Dicuci',
                                    'desc' => 'Pakaian sedang diproses menggunakan deterjen ramah lingkungan kami.',
                                    'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>'
                                ],
                                'disetrika' => [
                                    'title' => 'Sedang Disetrika',
                                    'desc' => 'Pakaian disetrika rapi dan dilipat harum siap dibungkus.',
                                    'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>'
                                ],
                                'siap_diambil' => [
                                    'title' => 'Siap Diambil',
                                    'desc' => 'Pakaian sudah bersih, wangi, dan siap diambil di outlet WashWire.',
                                    'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>'
                                ]
                            ];
                        @endphp

                        <div class="relative pl-8 space-y-6 before:absolute before:left-[15px] before:top-2 before:bottom-2 before:w-px before:bg-zinc-200 dark:before:bg-zinc-800">
                            @foreach($statuses as $index => $stat)
                                @php
                                    $isCompleted = $index < $currentStatusIndex;
                                    $isActive = $index === $currentStatusIndex;
                                    $isFuture = $index > $currentStatusIndex;

                                    $circleClass = 'bg-zinc-100 text-zinc-400 border-zinc-200 dark:bg-zinc-800 dark:text-zinc-500 dark:border-zinc-700';
                                    if ($isActive) {
                                        $circleClass = 'bg-[#b45ef7] text-white border-[#b45ef7] ring-4 ring-[#b45ef7]/20';
                                    } elseif ($isCompleted) {
                                        $circleClass = 'bg-emerald-500 text-white border-emerald-500';
                                    }

                                    $titleClass = 'text-zinc-400 dark:text-zinc-500';
                                    if ($isActive) {
                                        $titleClass = 'text-zinc-900 dark:text-zinc-50 font-semibold';
                                    } elseif ($isCompleted) {
                                        $titleClass = 'text-zinc-700 dark:text-zinc-300 font-medium';
                                    }

                                    $descClass = 'text-zinc-400 dark:text-zinc-500';
                                    if ($isActive) {
                                        $descClass = 'text-zinc-600 dark:text-zinc-300 text-sm';
                                    } elseif ($isCompleted) {
                                        $descClass = 'text-zinc-500 dark:text-zinc-400 text-sm';
                                    }
                                @endphp

                                <div class="relative flex gap-4">
                                    {{-- Bullet indicator --}}
                                    <div class="absolute -left-[29px] top-0.5 w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-300 {{ $circleClass }} z-10">
                                        {!! $statusMetadata[$stat]['icon'] !!}
                                    </div>

                                    {{-- Content --}}
                                    <div class="flex-grow pt-1">
                                        <h4 class="text-sm tracking-tight transition-colors duration-200 {{ $titleClass }}">
                                            {{ $statusMetadata[$stat]['title'] }}
                                            @if($isActive)
                                                <span class="ms-2 inline-flex items-center rounded-md border border-[#b45ef7]/20 bg-[#b45ef7]/10 px-2 py-0.5 text-[10px] font-semibold text-[#b45ef7] dark:border-[#b45ef7]/30 dark:bg-[#b45ef7]/20">
                                                    PROSES
                                                </span>
                                            @endif
                                        </h4>
                                        <p class="text-sm transition-colors mt-1 leading-relaxed {{ $descClass }}">
                                            {{ $statusMetadata[$stat]['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Summary Card Details --}}
                    <div class="bg-zinc-50 dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-800 rounded-lg p-5">
                        <h4 class="text-sm font-medium text-zinc-500 dark:text-zinc-400 mb-3">Rincian Cucian</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Nama Pelanggan</p>
                                <p class="font-medium text-zinc-900 dark:text-zinc-50 mt-0.5">{{ $detailTransaksi->nama_pelanggan }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Layanan Paket</p>
                                <p class="font-medium text-zinc-900 dark:text-zinc-50 mt-0.5">{{ $detailTransaksi->paket->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Berat Cucian</p>
                                <p class="font-medium text-zinc-900 dark:text-zinc-50 mt-0.5">{{ $detailTransaksi->berat }} kg</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Diterima Oleh</p>
                                <p class="font-medium text-zinc-900 dark:text-zinc-50 mt-0.5">{{ $detailTransaksi->kasir->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-12 text-center h-full flex flex-col justify-center items-center min-h-[400px]">
                    <div class="w-14 h-14 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-50">Pilih Nota Untuk Melihat Detail</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1 max-w-sm">
                        Silakan cari nota cucian Anda di form atas, kemudian pilih dari daftar hasil pencarian untuk melihat timeline pelacakan secara detail.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
