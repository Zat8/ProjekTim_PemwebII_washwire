<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class TransaksiTracking extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function ubahStatus($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $statusBerikutnya = $transaksi->statusBerikutnya();

        if ($statusBerikutnya) {
            $transaksi->update(['status' => $statusBerikutnya]);
            session()->flash('success', "Status transaksi {$transaksi->no_nota} diperbarui ke " . str_replace('_', ' ', $statusBerikutnya));
        }
    }

    public function render()
    {
        $transaksis = Transaksi::with(['paket', 'kasir'])
            ->when($this->search, function ($q) {
                $q->where('no_nota', 'like', '%' . $this->search . '%')
                  ->orWhere('nama_pelanggan', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.transaksi-tracking', ['transaksis' => $transaksis])
            ->layout('layouts.app');
    }
}