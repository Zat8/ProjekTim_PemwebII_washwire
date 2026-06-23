<div class="max-w-4xl mx-auto space-y-6">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/50 dark:text-emerald-300 flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            <div class="text-sm font-medium flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Form Kiri --}}
        <div class="lg:col-span-2 bg-white dark:bg-zinc-900 p-6 md:p-8 rounded-lg border border-zinc-200 dark:border-zinc-800 space-y-6">
            <div>
                <h1 class="text-xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight">Kasir WashWire</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Registrasi transaksi laundry masuk untuk pelanggan baru</p>
            </div>

            {{-- ID ditambahkan ke form agar tombol di luar bisa men-trigger submit --}}
            <form id="formLaundry" wire:submit="simpan" class="space-y-5">
                {{-- Nama Pelanggan --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Nama Pelanggan</label>
                    <input wire:model.live="nama_pelanggan" type="text"
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 dark:placeholder:text-zinc-500 transition-colors @error('nama_pelanggan') border-red-500 focus:ring-red-500/20 focus:border-red-500 dark:border-red-500 @enderror"
                        placeholder="Nama lengkap pelanggan..." />
                    @error('nama_pelanggan') <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- No HP --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-900 dark:text-zinc-50">No. HP / WhatsApp</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">+62</span>
                        </div>
                        <input wire:model.live="no_hp" type="text"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white pl-12 pr-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 dark:placeholder:text-zinc-500 transition-colors @error('no_hp') border-red-500 focus:ring-red-500/20 focus:border-red-500 dark:border-red-500 @enderror"
                            placeholder="81234567890" />
                    </div>
                    @error('no_hp') <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                {{-- Jenis Paket & Berat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Jenis Paket</label>
                        <select wire:model.live="paket_laundry_id"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 transition-colors @error('paket_laundry_id') border-red-500 focus:ring-red-500/20 focus:border-red-500 dark:border-red-500 @enderror">
                            <option value="">Pilih Paket</option>
                            @foreach ($pakets as $paket)
                                <option value="{{ $paket->id }}">
                                    {{ $paket->nama }} (Rp {{ number_format($paket->harga_per_kg, 0, ',', '.') }}/{{ $paket->satuan }})
                                </option>
                            @endforeach
                        </select>
                        @error('paket_laundry_id') <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-900 dark:text-zinc-50">Jumlah / Berat</label>
                        <input wire:model.live="berat" type="number" step="0.1"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#b45ef7]/20 focus:border-[#b45ef7] disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-50 dark:placeholder:text-zinc-500 transition-colors @error('berat') border-red-500 focus:ring-red-500/20 focus:border-red-500 dark:border-red-500 @enderror"
                            placeholder="2.5" />
                        @error('berat') <p class="text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>
            </form>
        </div>

        {{-- Ringkasan Kanan --}}
        <div class="bg-white dark:bg-zinc-900 p-6 md:p-8 rounded-lg border border-zinc-200 dark:border-zinc-800 flex flex-col justify-between space-y-6 h-fit">
            <div class="space-y-4">
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-50 pb-3 border-b border-zinc-200 dark:border-zinc-800">
                    Ringkasan Nota
                </h3>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Nama</span>
                        <span class="font-medium text-zinc-900 dark:text-zinc-50 text-right">{{ $nama_pelanggan ?: '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">No. HP</span>
                        <span class="font-medium text-zinc-900 dark:text-zinc-50 text-right">{{ $no_hp ? '+62 ' . $no_hp : '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Paket</span>
                        <span class="font-medium text-zinc-900 dark:text-zinc-50 text-right">
                            @if($paket_laundry_id)
                                {{ $pakets->find($paket_laundry_id)?->nama }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Berat</span>
                        <span class="font-medium text-zinc-900 dark:text-zinc-50 text-right">
                            @if($paket_laundry_id)
                                {{ $berat ?: '0' }} {{ $pakets->find($paket_laundry_id)?->satuan }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pt-4 border-t border-zinc-200 dark:border-zinc-800">
                {{-- Total Harga (Real-time) --}}
                <div class="bg-[#b45ef7] rounded-lg p-5 text-center text-white">
                    <p class="text-sm font-medium text-white mb-1">Total Pembayaran</p>
                    <p class="text-2xl font-bold tracking-tight">
                        Rp {{ number_format($this->totalHarga, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Tombol diubah memakai form attribute agar lebih standar semantik HTML --}}
                <button type="submit" form="formLaundry"
                    class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-md bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 dark:bg-zinc-50 dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    Simpan & Cetak Nota
                </button>
            </div>
        </div>
    </div>

    {{-- Skrip pendengar event untuk membuka tab baru --}}
    @script
    <script>
        $wire.on('buka-struk-baru', (event) => {
            window.open(event.url, '_blank');
        });
    </script>
    @endscript
</div>
