<div class="max-w-4xl mx-auto animate-fade-in">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
            </div>
            <div class="text-sm font-semibold flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form Kiri --}}
        <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Kasir WashWire</h1>
                <p class="text-xs text-slate-500 mt-1">Registrasi transaksi laundry masuk untuk pelanggan baru</p>
            </div>

            {{-- ID ditambahkan ke form agar tombol di luar bisa men-trigger submit --}}
            <form id="formLaundry" wire:submit="simpan" class="space-y-5">
                {{-- Nama Pelanggan --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Pelanggan</label>
                    <input wire:model.live="nama_pelanggan" type="text"
                        class="w-full bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl px-4 py-2.5 text-sm transition @error('nama_pelanggan') border-red-300 focus:ring-red-200 @enderror"
                        placeholder="Nama lengkap pelanggan..." />
                    @error('nama_pelanggan') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- No HP --}}
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">No. HP / WhatsApp</label>
                    <div class="relative rounded-xl shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-400 text-sm font-semibold">+62</span>
                        </div>
                        <input wire:model.live="no_hp" type="text"
                            class="w-full bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl pl-12 pr-4 py-2.5 text-sm transition @error('no_hp') border-red-300 focus:ring-red-200 @enderror"
                            placeholder="Contoh: 81234567890" />
                    </div>
                    @error('no_hp') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- Jenis Paket & Berat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Jenis Paket</label>
                        <select wire:model.live="paket_laundry_id"
                            class="w-full bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl px-4 py-2.5 text-sm transition @error('paket_laundry_id') border-red-300 focus:ring-red-200 @enderror">
                            <option value="">Pilih Paket</option>
                            @foreach ($pakets as $paket)
                                <option value="{{ $paket->id }}">
                                    {{ $paket->nama }} (Rp {{ number_format($paket->harga_per_kg, 0, ',', '.') }}/{{ $paket->satuan }})
                                </option>
                            @endforeach
                        </select>
                        @error('paket_laundry_id') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Jumlah / Berat</label>
                        <input wire:model.live="berat" type="number" step="0.1"
                            class="w-full bg-slate-50 border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl px-4 py-2.5 text-sm transition @error('berat') border-red-300 focus:ring-red-200 @enderror"
                            placeholder="Contoh: 2.5" />
                        @error('berat') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>
            </form>
        </div>

        {{-- Ringkasan Kanan --}}
        <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between space-y-6 h-fit">
            <div class="space-y-4">
                <h3 class="font-bold text-slate-800 text-base pb-3 border-b border-slate-100 flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-indigo-600 rounded-full"></span>
                    Ringkasan Nota
                </h3>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-slate-500">
                        <span>Nama:</span>
                        <span class="font-bold text-slate-800">{{ $nama_pelanggan ?: '-' }}</span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>No. HP:</span>
                        <span class="font-semibold text-slate-800">{{ $no_hp ? '+62 ' . $no_hp : '-' }}</span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>Paket:</span>
                        <span class="font-semibold text-slate-800">
                            @if($paket_laundry_id)
                                {{ $pakets->find($paket_laundry_id)?->nama }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>Satuan:</span>
                        <span class="font-semibold text-slate-800">
                            @if($paket_laundry_id)
                                {{ $berat ?: '0' }} {{ $pakets->find($paket_laundry_id)?->satuan }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                {{-- Total Harga (Real-time) --}}
                <div class="bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-2xl p-5 text-center text-white shadow-lg shadow-emerald-100">
                    <p class="text-xs text-white/80 font-bold uppercase tracking-wider mb-1">Total Pembayaran</p>
                    <p class="text-3xl font-black">
                        Rp {{ number_format($this->totalHarga, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Tombol diubah memakai form attribute agar lebih standar semantik HTML --}}
                <button type="submit" form="formLaundry"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-2xl transition shadow-md shadow-indigo-100 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
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
