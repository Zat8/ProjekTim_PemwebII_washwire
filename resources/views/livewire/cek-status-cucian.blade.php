<div x-data="{ dark: document.documentElement.classList.contains('dark') }"
     x-init="window.addEventListener('darkmode-changed', e => dark = e.detail.dark)"
     class="min-h-screen flex flex-col">

    {{-- Top Bar --}}
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-lg border-b border-zinc-200/60 dark:border-zinc-800/60">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#9737e3] to-[#b45ef7] flex items-center justify-center text-white shadow-md shadow-[#9737e3]/20">
                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm3 4a1 1 0 11-2 0 1 1 0 012 0zm10 0a1 1 0 11-2 0 1 1 0 012 0zM7 12a5 5 0 1110 0 5 5 0 01-10 0z"/>
                    </svg>
                </div>
                <span class="font-bold text-base text-zinc-900 dark:text-zinc-50 tracking-tight">WashWire</span>
            </div>

            <div class="flex items-center gap-2">
                {{-- Dark Mode Toggle --}}
                <button
                    onclick="toggleDarkMode()"
                    @click="dark = !dark"
                    title="Toggle dark mode"
                    class="w-9 h-9 flex items-center justify-center rounded-lg border border-zinc-200 bg-white text-zinc-500 hover:bg-zinc-100 hover:text-zinc-700 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-200 transition-all duration-200"
                >
                    <svg x-show="dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14A7 7 0 0012 5z" />
                    </svg>
                    <svg x-show="!dark" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                {{-- Staff Login Link --}}
                @if (Route::has('login'))
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:text-zinc-200 dark:hover:bg-zinc-800 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login Staff
                    </a>
                @endif
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow">
        {{-- Hero + Search Section --}}
        <section class="relative overflow-hidden">
            {{-- Background Gradient --}}
            <div class="absolute inset-0 bg-gradient-to-br from-[#9737e3]/5 via-transparent to-[#b45ef7]/5 dark:from-[#9737e3]/10 dark:via-transparent dark:to-[#b45ef7]/10"></div>
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-[#9737e3]/5 dark:bg-[#9737e3]/10 rounded-full blur-3xl -translate-y-1/2 pointer-events-none"></div>

            <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10 sm:pt-24 sm:pb-14 text-center">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-1.5 rounded-full border border-[#9737e3]/20 bg-[#9737e3]/5 dark:bg-[#9737e3]/10 dark:border-[#9737e3]/30 px-3 py-1 mb-5">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#9737e3] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#9737e3]"></span>
                    </span>
                    <span class="text-xs font-semibold text-[#9737e3]">Tracking Real-time</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-zinc-900 dark:text-zinc-50 tracking-tight leading-tight">
                    Lacak Status
                    <span class="bg-gradient-to-r from-[#9737e3] to-[#b45ef7] bg-clip-text text-transparent">Cucian Anda</span>
                </h1>
                <p class="mt-4 text-base sm:text-lg text-zinc-500 dark:text-zinc-400 max-w-xl mx-auto leading-relaxed">
                    Masukkan nomor invoice yang tertera pada struk untuk melacak progress pengerjaan cucian Anda secara real-time.
                </p>

                {{-- Search Form --}}
                <form wire:submit.prevent="cariStatus" class="mt-8 max-w-lg mx-auto">
                    <div class="relative flex items-center gap-2 p-1.5 bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-lg shadow-zinc-900/5 dark:shadow-zinc-950/50 focus-within:border-[#9737e3]/40 focus-within:ring-4 focus-within:ring-[#9737e3]/10 transition-all duration-300">
                        <div class="absolute left-4 pointer-events-none">
                            <svg class="w-5 h-5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            wire:model="search"
                            type="text"
                            id="invoice-search"
                            placeholder="Contoh: INV-0001"
                            autocomplete="off"
                            class="flex-grow h-11 bg-transparent pl-10 pr-2 text-sm sm:text-base text-zinc-900 dark:text-zinc-50 placeholder:text-zinc-400 focus:outline-none"
                        />
                        <button type="submit"
                                class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gradient-to-r from-[#9737e3] to-[#b45ef7] text-white text-sm font-semibold hover:from-[#8429d1] hover:to-[#a04de0] focus:outline-none focus:ring-2 focus:ring-[#9737e3]/40 focus:ring-offset-2 dark:focus:ring-offset-zinc-900 transition-all duration-200 shadow-md shadow-[#9737e3]/20 active:scale-[0.97]">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="hidden sm:inline">Lacak</span>
                        </button>
                    </div>
                    @error('search')
                        <p class="mt-2 text-sm text-red-500 dark:text-red-400 text-left pl-2">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </section>

        {{-- Results Section --}}
        <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            {{-- Loading Indicator --}}
            <div wire:loading wire:target="cariStatus" class="flex justify-center py-12">
                <div class="flex items-center gap-3 text-[#9737e3]">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm font-medium">Mencari transaksi...</span>
                </div>
            </div>

            <div wire:loading.remove wire:target="cariStatus">
                {{-- Initial State --}}
                @if(!$searched)
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-5 text-center group hover:border-[#9737e3]/30 hover:shadow-md hover:shadow-[#9737e3]/5 transition-all duration-300">
                            <div class="w-11 h-11 mx-auto rounded-xl bg-gradient-to-br from-[#9737e3]/10 to-[#b45ef7]/10 dark:from-[#9737e3]/20 dark:to-[#b45ef7]/20 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 text-[#9737e3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-50">Cek Struk</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1.5 leading-relaxed">Temukan nomor invoice di struk yang diberikan saat pengantaran cucian</p>
                        </div>

                        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-5 text-center group hover:border-[#9737e3]/30 hover:shadow-md hover:shadow-[#9737e3]/5 transition-all duration-300">
                            <div class="w-11 h-11 mx-auto rounded-xl bg-gradient-to-br from-[#9737e3]/10 to-[#b45ef7]/10 dark:from-[#9737e3]/20 dark:to-[#b45ef7]/20 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 text-[#9737e3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-50">Masukkan Nomor</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1.5 leading-relaxed">Ketik nomor invoice pada kolom pencarian di atas lalu klik tombol Lacak</p>
                        </div>

                        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-5 text-center group hover:border-[#9737e3]/30 hover:shadow-md hover:shadow-[#9737e3]/5 transition-all duration-300">
                            <div class="w-11 h-11 mx-auto rounded-xl bg-gradient-to-br from-[#9737e3]/10 to-[#b45ef7]/10 dark:from-[#9737e3]/20 dark:to-[#b45ef7]/20 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 text-[#9737e3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-50">Lihat Progress</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1.5 leading-relaxed">Pantau status pengerjaan cucian Anda secara detail dan real-time</p>
                        </div>
                    </div>
                @endif

                {{-- Not Found State --}}
                @if($notFound)
                    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-10 text-center mt-4">
                        <div class="w-16 h-16 mx-auto rounded-2xl bg-red-50 dark:bg-red-950/30 border border-red-100 dark:border-red-900/50 flex items-center justify-center mb-5">
                            <svg class="w-8 h-8 text-red-400 dark:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-50">Transaksi Tidak Ditemukan</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-2 max-w-sm mx-auto leading-relaxed">
                            Tidak ada transaksi dengan nomor invoice <strong class="text-zinc-700 dark:text-zinc-300">"{{ $search }}"</strong>. Periksa kembali nomor yang tertera pada struk Anda.
                        </p>
                    </div>
                @endif

                {{-- Found — Transaction Detail + Timeline --}}
                @if($transaksi)
                    <div class="space-y-5 mt-4" x-data x-init="$el.classList.add('animate-fade-in')">

                        {{-- Transaction Info Card --}}
                        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm">
                            {{-- Card Header --}}
                            <div class="bg-gradient-to-r from-[#9737e3] to-[#b45ef7] px-6 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                                <div>
                                    <p class="text-sm text-white/70 font-medium">Nomor Invoice</p>
                                    <h2 class="text-xl sm:text-2xl font-bold text-white tracking-tight mt-0.5">{{ $transaksi->no_nota }}</h2>
                                </div>
                                <div class="text-left sm:text-right">
                                    <p class="text-sm text-white/70 font-medium">Total Biaya</p>
                                    <p class="text-xl sm:text-2xl font-bold text-white tracking-tight mt-0.5">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            {{-- Details Grid --}}
                            <div class="p-6 grid grid-cols-2 sm:grid-cols-4 gap-5">
                                <div>
                                    <p class="text-xs font-medium text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Pelanggan</p>
                                    <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-50 mt-1">{{ $transaksi->nama_pelanggan }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Paket</p>
                                    <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-50 mt-1">{{ $transaksi->paket->nama }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Berat</p>
                                    <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-50 mt-1">{{ number_format($transaksi->berat, 1) }} kg</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-zinc-400 dark:text-zinc-500 uppercase tracking-wider">Tanggal Masuk</p>
                                    <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-50 mt-1">{{ $transaksi->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Progress Timeline --}}
                        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6 shadow-sm">
                            <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-50 mb-7 flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#9737e3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-2 5h.01M9 16h.01M9 12h.01M12 12h3M12 16h3M12 10h3" />
                                </svg>
                                Status Pengerjaan
                            </h3>

                            @php
                                $statuses = $transaksi->statusUrutan();
                                $currentStatusIndex = array_search($transaksi->status, $statuses);

                                $statusMetadata = [
                                    'antrean' => [
                                        'title' => 'Dalam Antrean',
                                        'desc' => 'Pakaian telah diterima dan sedang menunggu giliran untuk diproses.',
                                        'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                                    ],
                                    'dicuci' => [
                                        'title' => 'Sedang Dicuci',
                                        'desc' => 'Pakaian sedang diproses pencucian menggunakan deterjen ramah lingkungan.',
                                        'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>'
                                    ],
                                    'disetrika' => [
                                        'title' => 'Sedang Disetrika',
                                        'desc' => 'Pakaian disetrika rapi dan dilipat harum siap dibungkus.',
                                        'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>'
                                    ],
                                    'siap_diambil' => [
                                        'title' => 'Siap Diambil',
                                        'desc' => 'Pakaian sudah bersih, wangi, dan siap diambil di outlet WashWire.',
                                        'icon' => '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>'
                                    ]
                                ];
                            @endphp

                            {{-- Horizontal Progress Bar (Desktop) --}}
                            <div class="hidden sm:block mb-8">
                                <div class="relative flex items-center justify-between">
                                    {{-- Background line --}}
                                    <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-1 bg-zinc-100 dark:bg-zinc-800 rounded-full"></div>
                                    {{-- Progress line --}}
                                    @php
                                        $progressWidth = count($statuses) > 1 ? ($currentStatusIndex / (count($statuses) - 1)) * 100 : 0;
                                    @endphp
                                    <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-gradient-to-r from-[#9737e3] to-[#b45ef7] rounded-full transition-all duration-700 ease-out"
                                         style="width: {{ $progressWidth }}%"></div>

                                    {{-- Step indicators --}}
                                    @foreach($statuses as $index => $stat)
                                        @php
                                            $isCompleted = $index < $currentStatusIndex;
                                            $isActive = $index === $currentStatusIndex;
                                            $isFuture = $index > $currentStatusIndex;
                                        @endphp
                                        <div class="relative z-10 flex flex-col items-center" style="width: {{ 100 / count($statuses) }}%">
                                            <div @class([
                                                'w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all duration-500',
                                                'bg-emerald-500 border-emerald-500 text-white shadow-md shadow-emerald-500/20' => $isCompleted,
                                                'bg-gradient-to-br from-[#9737e3] to-[#b45ef7] border-[#9737e3] text-white ring-4 ring-[#9737e3]/20 shadow-lg shadow-[#9737e3]/25 animate-pulse-slow' => $isActive,
                                                'bg-zinc-100 dark:bg-zinc-800 border-zinc-200 dark:border-zinc-700 text-zinc-400 dark:text-zinc-500' => $isFuture,
                                            ])>
                                                @if($isCompleted)
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @else
                                                    {!! $statusMetadata[$stat]['icon'] !!}
                                                @endif
                                            </div>
                                            <p @class([
                                                'mt-3 text-xs font-semibold text-center whitespace-nowrap',
                                                'text-emerald-600 dark:text-emerald-400' => $isCompleted,
                                                'text-[#9737e3]' => $isActive,
                                                'text-zinc-400 dark:text-zinc-500' => $isFuture,
                                            ])>
                                                {{ $statusMetadata[$stat]['title'] }}
                                            </p>
                                            @if($isActive)
                                                <span class="mt-1.5 inline-flex items-center rounded-full bg-[#9737e3]/10 dark:bg-[#9737e3]/20 border border-[#9737e3]/20 dark:border-[#9737e3]/30 px-2 py-0.5 text-[10px] font-bold text-[#9737e3] uppercase tracking-wider">
                                                    Proses
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Vertical Timeline (Mobile) --}}
                            <div class="sm:hidden">
                                <div class="relative pl-8 space-y-6 before:absolute before:left-[15px] before:top-2 before:bottom-2 before:w-px before:bg-zinc-200 dark:before:bg-zinc-800">
                                    @foreach($statuses as $index => $stat)
                                        @php
                                            $isCompleted = $index < $currentStatusIndex;
                                            $isActive = $index === $currentStatusIndex;
                                            $isFuture = $index > $currentStatusIndex;
                                        @endphp
                                        <div class="relative flex gap-4">
                                            <div @class([
                                                'absolute -left-[17px] top-0.5 w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-300 z-10',
                                                'bg-emerald-500 border-emerald-500 text-white' => $isCompleted,
                                                'bg-gradient-to-br from-[#9737e3] to-[#b45ef7] border-[#9737e3] text-white ring-4 ring-[#9737e3]/20' => $isActive,
                                                'bg-zinc-100 dark:bg-zinc-800 border-zinc-200 dark:border-zinc-700 text-zinc-400 dark:text-zinc-500' => $isFuture,
                                            ])>
                                                @if($isCompleted)
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @else
                                                    {!! $statusMetadata[$stat]['icon'] !!}
                                                @endif
                                            </div>
                                            <div class="flex-grow pt-0.5">
                                                <h4 @class([
                                                    'text-sm font-semibold',
                                                    'text-emerald-600 dark:text-emerald-400' => $isCompleted,
                                                    'text-zinc-900 dark:text-zinc-50' => $isActive,
                                                    'text-zinc-400 dark:text-zinc-500' => $isFuture,
                                                ])>
                                                    {{ $statusMetadata[$stat]['title'] }}
                                                    @if($isActive)
                                                        <span class="ms-2 inline-flex items-center rounded-full bg-[#9737e3]/10 dark:bg-[#9737e3]/20 border border-[#9737e3]/20 dark:border-[#9737e3]/30 px-2 py-0.5 text-[10px] font-bold text-[#9737e3] uppercase tracking-wider">
                                                            Proses
                                                        </span>
                                                    @endif
                                                </h4>
                                                <p @class([
                                                    'text-sm mt-1 leading-relaxed',
                                                    'text-zinc-500 dark:text-zinc-400' => $isCompleted || $isActive,
                                                    'text-zinc-300 dark:text-zinc-600' => $isFuture,
                                                ])>
                                                    {{ $statusMetadata[$stat]['desc'] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="border-t border-zinc-200 dark:border-zinc-800 bg-white/50 dark:bg-zinc-950/50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-zinc-400 dark:text-zinc-500">
                © {{ date('Y') }} WashWire Laundry. All rights reserved.
            </p>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-xs text-zinc-400 hover:text-zinc-600 dark:text-zinc-500 dark:hover:text-zinc-300 transition-colors">Login Staff</a>
                @endif
            </div>
        </div>
    </footer>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
    @keyframes pulse-slow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(151, 55, 227, 0.3); }
        50%      { box-shadow: 0 0 0 8px rgba(151, 55, 227, 0); }
    }
    .animate-pulse-slow {
        animation: pulse-slow 2.5s ease-in-out infinite;
    }
</style>
