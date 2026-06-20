<div class="space-y-6 animate-fade-in">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 shadow-sm">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" /></svg>
            </div>
            <div class="text-sm font-semibold">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Pelacakan & Status Cucian</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola siklus pengerjaan pakaian pelanggan secara real-time</p>
        </div>
        
        {{-- Search --}}
        <div class="relative w-full md:w-80 shadow-sm rounded-xl">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <input wire:model.live="search" type="text" placeholder="Cari no. nota atau nama..."
                class="w-full bg-white border border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-xl pl-9 pr-4 py-2.5 text-sm transition" />
        </div>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">No. Nota</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Paket</th>
                        <th class="px-6 py-4">Total Harga</th>
                        <th class="px-6 py-4">Tanggal Masuk</th>
                        <th class="px-6 py-4 text-center">Status Pengerjaan</th>
                        <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($transaksis as $transaksi)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-bold text-slate-800 tracking-tight">{{ $transaksi->no_nota }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-800">{{ $transaksi->nama_pelanggan }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $transaksi->no_hp ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-850 font-medium">{{ $transaksi->paket->nama }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $transaksi->berat }} kg</div>
                            </td>
                            <td class="px-6 py-4 font-extrabold text-slate-900">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-700 font-medium">{{ $transaksi->created_at->format('d M Y') }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $transaksi->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($transaksi->status !== 'siap_diambil')
                                    <button wire:click="ubahStatus({{ $transaksi->id }})"
                                        @class([
                                            'px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 mx-auto border shadow-sm',
                                            'bg-amber-50 text-amber-700 border-amber-100 hover:bg-amber-100' => $transaksi->status === 'antrean',
                                            'bg-indigo-50 text-indigo-700 border-indigo-100 hover:bg-indigo-100' => $transaksi->status === 'dicuci',
                                            'bg-orange-50 text-orange-700 border-orange-100 hover:bg-orange-100' => $transaksi->status === 'disetrika',
                                        ])
                                        title="Klik untuk lanjut ke status berikutnya">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
                                        {{ str_replace('_', ' ', ucfirst($transaksi->status)) }}
                                        <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                                    </button>
                                @else
                                    <span class="px-3.5 py-1.5 rounded-full text-xs font-bold inline-flex items-center gap-1 border bg-emerald-50 text-emerald-700 border-emerald-100 mx-auto">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        Siap Diambil
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('struk.cetak', $transaksi) }}" target="_blank"
                                       class="px-3 py-1.5 rounded-xl bg-slate-50 hover:bg-indigo-50 text-slate-500 hover:text-indigo-600 border border-slate-100 transition text-xs font-bold flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9" /></svg>
                                        Cetak Ulang
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12 text-slate-400 font-medium">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                    Tidak menemukan transaksi yang cocok.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $transaksis->links() }}
    </div>
</div>