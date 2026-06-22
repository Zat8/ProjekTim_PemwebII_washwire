<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;

class PelangganTracking extends Component
{
    public $search = '';
    public $results = null;
    public $detailTransaksi = null;
    public $searched = false;

    public function mount()
    {
        $user = auth()->user();
        if ($user && $user->no_hp) {
            $this->search = $user->no_hp;
            $this->lacak();
        }
    }

    public function lacak()
    {
        $this->validate([
            'search' => 'required|string|min:3',
        ]);

        $this->searched = true;
        $this->detailTransaksi = null;
        
        // Search by exact/partial invoice number or phone number
        $this->results = Transaksi::with(['paket', 'kasir'])
            ->where('no_nota', 'like', '%' . $this->search . '%')
            ->orWhere('no_hp', 'like', '%' . $this->search . '%')
            ->latest()
            ->get();

        // If there is only one result, automatically show its detail
        if ($this->results->count() === 1) {
            $this->detailTransaksi = $this->results->first();
        }
    }

    public function showDetail($id)
    {
        $this->detailTransaksi = Transaksi::with(['paket', 'kasir'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pelanggan.tracking')
            ->layout('layouts.app');
    }
}
