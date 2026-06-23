<div class="space-y-6">
    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 dark:border-emerald-900/50 dark:bg-emerald-950/50 dark:text-emerald-300 flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
            <div class="text-sm font-medium flex-grow">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold text-zinc-900 dark:text-zinc-50 tracking-tight">Kelola Paket Laundry</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Daftar tarif dan paket laundry yang tersedia untuk pelanggan</p>
        </div>
        <a href="{{ route('paket.buat') }}"
            class="inline-flex items-center justify-center whitespace-nowrap rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 dark:bg-zinc-50 dark:text-zinc-900 dark:hover:bg-zinc-200 transition-colors gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Tambah Paket Baru
        </a>
    </div>

    {{-- Tabel Paket --}}
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800">
                <tr>
                    <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Nama Paket</th>
                    <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Harga per Satuan</th>
                    <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400">Satuan</th>
                    <th class="px-6 py-3 font-medium text-zinc-500 dark:text-zinc-400 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse ($pakets as $paket)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-100">{{ $paket->nama }}</td>
                        <td class="px-6 py-4 font-semibold text-zinc-900 dark:text-zinc-100">
                            Rp {{ number_format($paket->harga_per_kg, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md border border-zinc-200 bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                per {{ $paket->satuan }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('paket.edit', $paket) }}"
                                   class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white h-9 w-9 hover:bg-zinc-100 hover:text-zinc-900 dark:border-zinc-800 dark:bg-zinc-950 dark:hover:bg-zinc-800 dark:hover:text-zinc-50 transition-colors"
                                   title="Edit Paket">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                <button wire:click="hapus({{ $paket->id }})"
                                    wire:confirm="Yakin ingin menghapus paket ini?"
                                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white h-9 w-9 hover:bg-red-50 hover:text-red-600 dark:border-zinc-800 dark:bg-zinc-950 dark:hover:bg-red-950/50 dark:hover:text-red-400 transition-colors"
                                    title="Hapus Paket">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-12 text-zinc-500 dark:text-zinc-400">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586-3.586a2 2 0 00-2.828 0L16 12m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 10" /></svg>
                                </div>
                                <p class="text-sm font-medium">Belum ada paket terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $pakets->links() }}
    </div>
</div>
