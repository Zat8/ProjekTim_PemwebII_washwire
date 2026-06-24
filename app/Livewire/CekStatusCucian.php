<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;

class CekStatusCucian extends Component
{
    public $search = '';
    public $transaksi = null;
    public $searched = false;
    public $notFound = false;

    public function cariStatus()
    {
        $this->validate([
            'search' => 'required|string|min:3',
        ], [
            'search.required' => 'Masukkan nomor invoice terlebih dahulu.',
            'search.min' => 'Nomor invoice minimal 3 karakter.',
        ]);

        $this->searched = true;
        $this->notFound = false;
        $this->transaksi = null;

        $result = Transaksi::with(['paket', 'kasir'])
            ->where('no_nota', 'like', '%' . $this->search . '%')
            ->latest()
            ->first();

        if ($result) {
            $this->transaksi = $result;
        } else {
            $this->notFound = true;
        }
    }

    public function updatedSearch()
    {
        // Reset state when user clears or modifies search
        if (empty($this->search)) {
            $this->searched = false;
            $this->notFound = false;
            $this->transaksi = null;
        }
    }

    public function render()
    {
        return view('livewire.cek-status-cucian')
            ->layout('layouts.guest-tracking');
    }
}
