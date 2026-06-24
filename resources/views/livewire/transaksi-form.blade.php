<div class="max-w-7xl mx-auto space-y-8 px-4 sm:px-0">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="border border-success bg-success-bright/10 p-4 text-success flex items-center gap-3 rounded-none">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            <div class="text-sm font-bold tracking-widest uppercase flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    <div class="pb-6 border-b border-hairline dark:border-stone">
        <h1 class="font-display uppercase text-[48px] leading-[0.9] text-ink dark:text-canvas tracking-tight">KASIR WASHWIRE</h1>
        <p class="text-xs font-bold uppercase tracking-widest text-mute dark:text-stone mt-2">Registrasi transaksi laundry masuk untuk pelanggan</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Form Kiri --}}
        <div class="w-full lg:w-2/3 bg-canvas dark:bg-ink p-8 sm:p-12 border border-hairline dark:border-stone rounded-none">
            {{-- ID ditambahkan ke form agar tombol di luar bisa men-trigger submit --}}
            <form id="formLaundry" wire:submit="simpan" class="space-y-8">
                {{-- Nama Pelanggan --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Nama Pelanggan</label>
                    <input wire:model.live="nama_pelanggan" type="text"
                        class="flex h-12 w-full rounded-none border border-hairline bg-transparent px-4 py-2 text-base text-ink placeholder:text-mute focus:outline-none focus:ring-0 focus:border-ink disabled:cursor-not-allowed disabled:opacity-50 dark:border-stone dark:text-canvas dark:placeholder:text-stone transition-colors @error('nama_pelanggan') border-sale focus:border-sale @enderror"
                        placeholder="Nama lengkap pelanggan..." />
                    @error('nama_pelanggan') <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- No HP --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">No. HP / WhatsApp</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-base text-mute dark:text-stone">+62</span>
                        </div>
                        <input wire:model.live="no_hp" type="text"
                            class="flex h-12 w-full rounded-none border border-hairline bg-transparent pl-14 pr-4 py-2 text-base text-ink placeholder:text-mute focus:outline-none focus:ring-0 focus:border-ink disabled:cursor-not-allowed disabled:opacity-50 dark:border-stone dark:text-canvas dark:placeholder:text-stone transition-colors @error('no_hp') border-sale focus:border-sale @enderror"
                            placeholder="81234567890" />
                    </div>
                    @error('no_hp') <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Jenis Paket & Berat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Jenis Paket</label>
                        <select wire:model.live="paket_laundry_id"
                            class="flex h-12 w-full rounded-none border border-hairline bg-transparent px-4 py-2 text-base text-ink focus:outline-none focus:ring-0 focus:border-ink disabled:cursor-not-allowed disabled:opacity-50 dark:border-stone dark:text-canvas transition-colors @error('paket_laundry_id') border-sale focus:border-sale @enderror">
                            <option value="" class="dark:bg-ink">Pilih Paket</option>
                            @foreach ($pakets as $paket)
                                <option value="{{ $paket->id }}" class="dark:bg-ink">
                                    {{ $paket->nama }} (Rp {{ number_format($paket->harga_per_kg, 0, ',', '.') }}/{{ $paket->satuan }})
                                </option>
                            @endforeach
                        </select>
                        @error('paket_laundry_id') <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-ink dark:text-canvas">Jumlah / Berat</label>
                        <input wire:model.live="berat" type="number" step="0.1"
                            class="flex h-12 w-full rounded-none border border-hairline bg-transparent px-4 py-2 text-base text-ink placeholder:text-mute focus:outline-none focus:ring-0 focus:border-ink disabled:cursor-not-allowed disabled:opacity-50 dark:border-stone dark:text-canvas dark:placeholder:text-stone transition-colors @error('berat') border-sale focus:border-sale @enderror"
                            placeholder="2.5" />
                        @error('berat') <p class="text-[10px] font-bold uppercase tracking-widest text-sale mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </form>
        </div>

        {{-- Ringkasan Kanan --}}
        <div class="w-full lg:w-1/3 bg-soft-cloud dark:bg-charcoal p-8 sm:p-12 border border-hairline dark:border-stone flex flex-col h-fit rounded-none">
            <h3 class="text-sm font-bold uppercase tracking-widest text-ink dark:text-canvas pb-4 border-b border-hairline dark:border-stone mb-6">
                Ringkasan Nota
            </h3>

            <div class="space-y-4 text-sm mb-12">
                <div class="flex justify-between border-b border-hairline dark:border-stone pb-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-mute dark:text-stone">Nama</span>
                    <span class="font-bold text-ink dark:text-canvas text-right uppercase">{{ $nama_pelanggan ?: '-' }}</span>
                </div>
                <div class="flex justify-between border-b border-hairline dark:border-stone pb-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-mute dark:text-stone">No. HP</span>
                    <span class="font-bold text-ink dark:text-canvas text-right">{{ $no_hp ? '+62 ' . $no_hp : '-' }}</span>
                </div>
                <div class="flex justify-between border-b border-hairline dark:border-stone pb-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-mute dark:text-stone">Paket</span>
                    <span class="font-bold text-ink dark:text-canvas text-right uppercase">
                        @if($paket_laundry_id)
                            {{ $pakets->find($paket_laundry_id)?->nama }}
                        @else
                            -
                        @endif
                    </span>
                </div>
                <div class="flex justify-between border-b border-hairline dark:border-stone pb-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-mute dark:text-stone">Berat</span>
                    <span class="font-bold text-ink dark:text-canvas text-right uppercase">
                        @if($paket_laundry_id)
                            {{ $berat ?: '0' }} {{ $pakets->find($paket_laundry_id)?->satuan }}
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>

            <div class="space-y-6 mt-auto">
                {{-- Total Harga (Real-time) --}}
                <div class="bg-ink dark:bg-canvas p-6 text-center text-canvas dark:text-ink border border-ink dark:border-canvas rounded-none">
                    <p class="text-[10px] font-bold uppercase tracking-widest mb-2 opacity-80">Total Pembayaran</p>
                    <p class="font-display text-[48px] leading-[1]">
                        Rp {{ number_format($this->totalHarga, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Tombol diubah memakai form attribute agar lebih standar semantik HTML --}}
                <button type="submit" form="formLaundry"
                    class="w-full inline-flex items-center justify-center whitespace-nowrap rounded-full bg-ink dark:bg-canvas px-6 py-4 text-[11px] font-bold uppercase tracking-widest text-canvas dark:text-ink hover:opacity-80 transition-colors gap-2 focus:outline-none focus:ring-2 focus:ring-ink focus:ring-offset-2 dark:focus:ring-canvas">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                    SIMPAN & CETAK NOTA
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
