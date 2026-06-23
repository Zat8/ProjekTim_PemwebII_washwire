<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketLaundry extends Model
{
    use HasFactory;
    protected $table = 'paket_laundrys';

    protected $fillable = ['nama', 'harga_per_kg', 'satuan'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
