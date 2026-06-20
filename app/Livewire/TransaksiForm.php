<?php

namespace App\Livewire;

use App\Models\PaketLaundry;
use App\Models\Transaksi;
use Livewire\Component;

class TransaksiForm extends Component
{
    public $nama_pelanggan = '';
    public $no_hp = '';
    public $paket_laundry_id = '';
    public $berat = '';

    public function rules()
    {
        return [
            'nama_pelanggan' => 'required|min:3|max:100',
            'no_hp' => 'nullable|min:8|max:15',
            'paket_laundry_id' => 'required|exists:paket_laundrys,id',
            'berat' => 'required|numeric|min:0.1',
        ];
    }

    // Hitung total harga secara real-time (computed property)
    #[\Livewire\Attributes\Computed]
    public function totalHarga()
    {
        if (!$this->paket_laundry_id || !$this->berat) {
            return 0;
        }

        $paket = PaketLaundry::find($this->paket_laundry_id);

        if (!$paket) {
            return 0;
        }

        return $paket->harga_per_kg * (float) $this->berat;
    }

    public function simpan()
    {
        $this->validate();

        $noNota = 'INV-' . str_pad((Transaksi::count() + 1), 4, '0', STR_PAD_LEFT);

        $transaksi = Transaksi::create([
            'no_nota' => $noNota,
            'nama_pelanggan' => $this->nama_pelanggan,
            'no_hp' => $this->no_hp,
            'paket_laundry_id' => $this->paket_laundry_id,
            'berat' => $this->berat,
            'total_harga' => $this->totalHarga,
            'status' => 'antrean',
            'user_id' => auth()->id(),
        ]);

        session()->flash('success', "Transaksi $noNota berhasil dibuat!");

        $this->reset(['nama_pelanggan', 'no_hp', 'paket_laundry_id', 'berat']);
        return $this->redirect(route('struk.cetak', $transaksi), navigate: false);
    }

    public function render()
    {
        return view('livewire.transaksi-form', [
            'pakets' => PaketLaundry::all(),
        ])->layout('layouts.app');
    }
}