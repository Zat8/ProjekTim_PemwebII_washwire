<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketLaundry extends Model
{
    protected $table = 'paket_laundrys';

    protected $fillable = ['nama', 'harga_per_kg', 'satuan'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
