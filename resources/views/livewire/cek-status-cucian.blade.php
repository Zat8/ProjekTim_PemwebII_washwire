<div x-data="{ dark: document.documentElement.classList.contains('dark') }"
     x-init="window.addEventListener('darkmode-changed', e => dark = e.detail.dark)"
     class="min-h-screen flex flex-col bg-canvas dark:bg-ink text-ink dark:text-canvas">

    {{-- Top Bar --}}
    <header class="sticky top-0 z-50 bg-canvas dark:bg-ink border-b border-hairline dark:border-stone">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 bg-ink dark:bg-canvas flex items-center justify-center text-canvas dark:text-ink">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7.893a2 2 0 01-1.696 1.977 8.001 8.001 0 11-13.4-.047 2 2 0 01-1.4-1.93 2 2 0 011.8-1.996 8.001 8.001 0 0114.9 2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                    </svg>
                </div>
                <span class="font-bold text-lg tracking-tight uppercase">WashWire</span>
            </div>

            <div class="flex items-center gap-4">
                {{-- Dark Mode Toggle --}}
                <button
                    onclick="toggleDarkMode()"
                    @click="dark = !dark"
                    title="Toggle dark mode"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-soft-cloud text-ink hover:bg-hairline-soft dark:bg-charcoal dark:text-canvas dark:hover:bg-ash transition-colors"
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
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-soft-cloud dark:bg-charcoal text-sm font-medium hover:bg-hairline-soft dark:hover:bg-ash transition-colors">
                        Login Staff
                    </a>
                @endif
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow">
        {{-- Hero + Search Section --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-24 text-center">
            {{-- Heading --}}
            <h1 class="font-display uppercase text-[64px] sm:text-[96px] leading-[0.9] tracking-tight text-ink dark:text-canvas">
                LACAK STATUS<br>CUCIAN ANDA
            </h1>
            <p class="mt-6 text-base text-charcoal dark:text-stone max-w-xl mx-auto">
                Masukkan nomor invoice yang tertera pada struk untuk melacak progress pengerjaan cucian Anda secara real-time.
            </p>

            {{-- Search Form --}}
            <form wire:submit.prevent="cariStatus" class="mt-8 max-w-lg mx-auto relative">
                <div class="flex items-center bg-soft-cloud dark:bg-charcoal rounded-full p-1 focus-within:ring-2 focus-within:ring-ink dark:focus-within:ring-canvas transition-shadow">
                    <div class="pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-mute dark:text-stone" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        wire:model="search"
                        type="text"
                        id="invoice-search"
                        placeholder="Contoh: INV-0001"
                        autocomplete="off"
                        class="flex-grow h-12 bg-transparent pl-3 pr-2 text-base border-none focus:ring-0 placeholder:text-mute dark:placeholder:text-stone text-ink dark:text-canvas"
                    />
                    <button type="submit"
                            class="shrink-0 inline-flex items-center px-6 py-3 rounded-full bg-ink text-canvas dark:bg-canvas dark:text-ink text-sm font-medium hover:opacity-80 active:scale-95 transition-all">
                        Lacak
                    </button>
                </div>
                @error('search')
                    <p class="mt-2 text-sm text-sale text-left pl-4">{{ $message }}</p>
                @enderror
            </form>
        </section>

        {{-- Results Section --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            {{-- Loading Indicator --}}
            <div wire:loading wire:target="cariStatus" class="flex justify-center py-12">
                <div class="flex items-center gap-3 text-ink dark:text-canvas">
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
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-12 pt-12 border-t border-hairline dark:border-stone">
                        <div class="text-center">
                            <h3 class="text-[24px] font-medium leading-[1.2]">Cek Struk</h3>
                            <p class="text-base text-charcoal dark:text-stone mt-2">Temukan nomor invoice di struk yang diberikan saat pengantaran cucian</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-[24px] font-medium leading-[1.2]">Masukkan Nomor</h3>
                            <p class="text-base text-charcoal dark:text-stone mt-2">Ketik nomor invoice pada kolom pencarian di atas lalu klik tombol Lacak</p>
                        </div>
                        <div class="text-center">
                            <h3 class="text-[24px] font-medium leading-[1.2]">Lihat Progress</h3>
                            <p class="text-base text-charcoal dark:text-stone mt-2">Pantau status pengerjaan cucian Anda secara detail dan real-time</p>
                        </div>
                    </div>
                @endif

                {{-- Not Found State --}}
                @if($notFound)
                    <div class="bg-soft-cloud dark:bg-charcoal p-12 text-center mt-12">
                        <h3 class="text-[32px] font-medium leading-[1.2]">TRANSAKSI TIDAK DITEMUKAN</h3>
                        <p class="text-base text-charcoal dark:text-stone mt-4 max-w-md mx-auto">
                            Tidak ada transaksi dengan nomor invoice <strong class="text-ink dark:text-canvas">"{{ $search }}"</strong>. Periksa kembali nomor yang tertera pada struk Anda.
                        </p>
                    </div>
                @endif

                {{-- Found — Transaction Detail + Timeline --}}
                @if($transaksi)
                    <div class="mt-12 space-y-12">

                        {{-- Transaction Info Card --}}
                        <div class="bg-soft-cloud dark:bg-charcoal">
                            <div class="p-8 md:p-12 border-b border-hairline dark:border-stone flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                                <div>
                                    <h2 class="font-display uppercase text-[48px] leading-[0.9]">{{ $transaksi->no_nota }}</h2>
                                </div>
                                <div class="md:text-right">
                                    <p class="text-sm font-medium uppercase tracking-widest text-mute dark:text-stone mb-1">Total Biaya</p>
                                    <p class="text-[32px] font-medium leading-[1.2]">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="p-8 md:p-12 grid grid-cols-2 md:grid-cols-4 gap-8">
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-widest text-mute dark:text-stone mb-2">Pelanggan</p>
                                    <p class="text-base font-medium">{{ $transaksi->nama_pelanggan }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-widest text-mute dark:text-stone mb-2">Paket</p>
                                    <p class="text-base font-medium">{{ $transaksi->paket->nama }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-widest text-mute dark:text-stone mb-2">Berat</p>
                                    <p class="text-base font-medium">{{ number_format($transaksi->berat, 1) }} kg</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-widest text-mute dark:text-stone mb-2">Tanggal Masuk</p>
                                    <p class="text-base font-medium">{{ $transaksi->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Progress Timeline --}}
                        <div class="pt-8">
                            <h3 class="text-[32px] font-medium leading-[1.2] mb-12">STATUS PENGERJAAN</h3>

                            @php
                                $statuses = $transaksi->statusUrutan();
                                $currentStatusIndex = array_search($transaksi->status, $statuses);

                                $statusMetadata = [
                                    'antrean' => [
                                        'title' => 'DALAM ANTREAN',
                                        'desc' => 'Pakaian telah diterima dan menunggu diproses.'
                                    ],
                                    'dicuci' => [
                                        'title' => 'SEDANG DICUCI',
                                        'desc' => 'Pakaian sedang diproses pencucian.'
                                    ],
                                    'disetrika' => [
                                        'title' => 'SEDANG DISETRIKA',
                                        'desc' => 'Pakaian disetrika rapi.'
                                    ],
                                    'siap_diambil' => [
                                        'title' => 'SIAP DIAMBIL',
                                        'desc' => 'Pakaian sudah bisa diambil di outlet.'
                                    ]
                                ];
                            @endphp

                            {{-- Horizontal Progress Bar (Desktop) --}}
                            <div class="hidden sm:block">
                                <div class="relative flex items-center justify-between">
                                    {{-- Background line --}}
                                    <div class="absolute left-0 right-0 top-3 h-[2px] bg-hairline dark:bg-stone"></div>
                                    
                                    {{-- Progress line --}}
                                    @php
                                        $progressWidth = count($statuses) > 1 ? ($currentStatusIndex / (count($statuses) - 1)) * 100 : 0;
                                    @endphp
                                    <div class="absolute left-0 top-3 h-[2px] bg-ink dark:bg-canvas transition-all duration-700 ease-out"
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
                                                'w-6 h-6 rounded-full border-[2px] transition-all bg-canvas dark:bg-ink',
                                                'border-ink dark:border-canvas bg-ink dark:bg-canvas' => $isCompleted,
                                                'border-ink dark:border-canvas ring-4 ring-ink/20 dark:ring-canvas/20' => $isActive,
                                                'border-hairline dark:border-stone' => $isFuture,
                                            ])>
                                                @if($isCompleted)
                                                    <div class="w-full h-full flex items-center justify-center text-canvas dark:text-ink">
                                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <p @class([
                                                'mt-4 text-[14px] font-bold tracking-widest uppercase text-center whitespace-nowrap',
                                                'text-ink dark:text-canvas' => $isCompleted || $isActive,
                                                'text-mute dark:text-stone' => $isFuture,
                                            ])>
                                                {{ $statusMetadata[$stat]['title'] }}
                                            </p>
                                            <p class="mt-2 text-sm text-charcoal dark:text-stone text-center max-w-[200px]">
                                                {{ $statusMetadata[$stat]['desc'] }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Vertical Timeline (Mobile) --}}
                            <div class="sm:hidden space-y-8">
                                <div class="relative pl-8 before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[2px] before:bg-hairline dark:before:bg-stone">
                                    @foreach($statuses as $index => $stat)
                                        @php
                                            $isCompleted = $index < $currentStatusIndex;
                                            $isActive = $index === $currentStatusIndex;
                                            $isFuture = $index > $currentStatusIndex;
                                        @endphp
                                        <div class="relative mb-8 last:mb-0">
                                            <div @class([
                                                'absolute -left-[37px] top-1 w-6 h-6 rounded-full border-[2px] bg-canvas dark:bg-ink z-10 transition-all',
                                                'border-ink dark:border-canvas bg-ink dark:bg-canvas' => $isCompleted,
                                                'border-ink dark:border-canvas ring-4 ring-ink/20 dark:ring-canvas/20' => $isActive,
                                                'border-hairline dark:border-stone' => $isFuture,
                                            ])>
                                                @if($isCompleted)
                                                    <div class="w-full h-full flex items-center justify-center text-canvas dark:text-ink">
                                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 @class([
                                                    'text-[14px] font-bold tracking-widest uppercase',
                                                    'text-ink dark:text-canvas' => $isCompleted || $isActive,
                                                    'text-mute dark:text-stone' => $isFuture,
                                                ])>
                                                    {{ $statusMetadata[$stat]['title'] }}
                                                </h4>
                                                <p @class([
                                                    'text-sm mt-1',
                                                    'text-charcoal dark:text-stone' => $isCompleted || $isActive,
                                                    'text-mute dark:text-ash' => $isFuture,
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
    <footer class="border-t border-hairline dark:border-stone bg-canvas dark:bg-ink mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-[9px] font-medium tracking-widest text-mute dark:text-stone uppercase">
                © {{ date('Y') }} WashWire Laundry. All rights reserved.
            </p>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-[9px] font-medium tracking-widest text-mute hover:text-ink dark:text-stone dark:hover:text-canvas uppercase transition-colors">Login Staff</a>
                @endif
            </div>
        </div>
    </footer>
</div>
