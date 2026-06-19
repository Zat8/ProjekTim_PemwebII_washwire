<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'no_nota', 'nama_pelanggan', 'no_hp',
        'paket_laundry_id', 'berat', 'total_harga',
        'status', 'user_id',
    ];

    public function paket()
    {
        return $this->belongsTo(PaketLaundry::class, 'paket_laundry_id');
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Helper untuk status berikutnya
    public function statusBerikutnya(): ?string
    {
        $urutan = ['antrean', 'dicuci', 'disetrika', 'siap_diambil'];
        $index = array_search($this->status, $urutan);

        return $urutan[$index + 1] ?? null;
    }
}
