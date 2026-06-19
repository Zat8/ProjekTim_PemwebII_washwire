<?php

namespace App\Livewire;

use App\Models\PaketLaundry;
use Livewire\Component;
use Livewire\WithPagination;

class PaketIndex extends Component
{
    use WithPagination;

    public function hapus($id)
    {
        PaketLaundry::findOrFail($id)->delete();
        session()->flash('success', 'Paket berhasil dihapus.');
    }

    public function render()
    {
        $pakets = PaketLaundry::latest()->paginate(10);

        return view('livewire.paket-index', ['pakets' => $pakets])
            ->layout('layouts.app');
    }
}