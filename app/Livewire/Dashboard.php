<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public function render()
    {
        $totalTransaksiHariIni = Transaksi::whereDate('created_at', today())->count();
        $pemasukanHariIni = Transaksi::whereDate('created_at', today())->sum('total_harga');
        $cucianPending = Transaksi::where('status', '!=', 'siap_diambil')->count();
        $transaksiTerakhir = Transaksi::with('paket')->latest()->limit(5)->get();
        $transaksiSelesaiHariIni = Transaksi::whereDate('created_at', today())->where('status', 'siap_diambil')->get();
        $totalTransaksiSelesaiHariIni = Transaksi::whereDate('created_at', today())->where('status', 'siap_diambil')->count();

        return view('livewire.dashboard', [
            'totalTransaksiHariIni' => $totalTransaksiHariIni,
            'pemasukanHariIni' => $pemasukanHariIni,
            'cucianPending' => $cucianPending,
            'transaksiTerakhir' => $transaksiTerakhir,
            'transaksiSelesaiHariIni' => $transaksiSelesaiHariIni,
            'totalTransaksiSelesaiHariIni' => $totalTransaksiSelesaiHariIni,
        ])->layout('layouts.app');
    }
}