<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;

class PelangganDashboard extends Component
{
    public function render()
    {
        $user = auth()->user();
        $no_hp = $user->no_hp;

        if ($no_hp) {
            $transaksis = Transaksi::where('no_hp', $no_hp)->with('paket')->latest()->get();
            $cucianAktif = $transaksis->whereIn('status', ['antrean', 'dicuci', 'disetrika'])->count();
            $totalTransaksi = $transaksis->count();
            $siapDiambil = $transaksis->where('status', 'siap_diambil')->count();
        } else {
            $transaksis = collect();
            $cucianAktif = 0;
            $totalTransaksi = 0;
            $siapDiambil = 0;
        }

        return view('livewire.pelanggan.dashboard', [
            'transaksis' => $transaksis,
            'cucianAktif' => $cucianAktif,
            'totalTransaksi' => $totalTransaksi,
            'siapDiambil' => $siapDiambil,
            'no_hp' => $no_hp,
        ])->layout('layouts.app');
    }
}
