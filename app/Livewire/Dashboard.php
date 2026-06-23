<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalTransaksiHariIni = Transaksi::whereDate('created_at', today())->count();
        $pemasukanHariIni = Transaksi::whereDate('created_at', today())->sum('total_harga');
        $cucianPending = Transaksi::where('status', '!=', 'siap_diambil')->count();
        $transaksiTerakhir = Transaksi::with('paket')->latest()->limit(5)->get();
        $transaksiSelesai = Transaksi::where('status', 'siap_diambil')->get();

        return view('livewire.dashboard', [
            'totalTransaksiHariIni' => $totalTransaksiHariIni,
            'pemasukanHariIni' => $pemasukanHariIni,
            'cucianPending' => $cucianPending,
            'transaksiTerakhir' => $transaksiTerakhir,
            'transaksiSelesai' => $transaksiSelesai,
        ])->layout('layouts.app');
    }
}