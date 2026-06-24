<?php

namespace App\Livewire;

use App\Models\PaketLaundry;
use Livewire\Component;

class PaketForm extends Component
{
    public ?PaketLaundry $paket = null;
    public $nama = '';
    public $harga_per_kg = '';
    public $satuan = 'kg';
    public $alur_proses = 'cuci_setrika';

    public function mount(?PaketLaundry $paket = null)
    {
        if ($paket && $paket->exists) {
            $this->paket = $paket;
            $this->nama = $paket->nama;
            $this->harga_per_kg = $paket->harga_per_kg;
            $this->satuan = $paket->satuan;
            $this->alur_proses = $paket->alur_proses ?? 'cuci_setrika';
        }
    }

    protected function rules()
    {
        return [
            'nama' => 'required|min:3|max:100',
            'harga_per_kg' => 'required|numeric|min:0',
            'satuan' => 'required|in:kg,item',
            'alur_proses' => 'required|in:cuci_setrika,cuci_saja,setrika_saja',
        ];
    }

    public function simpan()
    {
        $this->validate();

        $data = [
            'nama' => $this->nama,
            'harga_per_kg' => $this->harga_per_kg,
            'satuan' => $this->satuan,
            'alur_proses' => $this->alur_proses,
        ];

        if ($this->paket?->exists) {
            $this->paket->update($data);
            session()->flash('success', 'Paket berhasil diperbarui.');
        } else {
            PaketLaundry::create($data);
            session()->flash('success', 'Paket berhasil dibuat.');
        }

        // return $this->redirect(route('paket.index'), navigate: true);
        return redirect()->route('paket.index');
    }

    public function render()
    {
        return view('livewire.paket-form')->layout('layouts.app');
    }
}