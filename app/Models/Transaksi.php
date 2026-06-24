<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
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

    // Mendapatkan urutan status berdasarkan alur proses paket
    public function statusUrutan(): array
    {
        if ($this->paket) {
            switch ($this->paket->alur_proses) {
                case 'cuci_saja':
                    return ['antrean', 'dicuci', 'siap_diambil'];
                case 'setrika_saja':
                    return ['antrean', 'disetrika', 'siap_diambil'];
                case 'cuci_setrika':
                default:
                    return ['antrean', 'dicuci', 'disetrika', 'siap_diambil'];
            }
        }

        return ['antrean', 'dicuci', 'disetrika', 'siap_diambil'];
    }

    // Helper untuk status berikutnya
    public function statusBerikutnya(): ?string
    {
        $urutan = $this->statusUrutan();
        $index = array_search($this->status, $urutan);

        if ($index === false) {
            return null;
        }

        return $urutan[$index + 1] ?? null;
    }
}
