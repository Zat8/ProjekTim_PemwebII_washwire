<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\User;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kasir = User::where('role', 'kasir')->first();

        $transaksis = [
            [
                'no_nota' => 'INV-0001',
                'nama_pelanggan' => 'Budi Santoso',
                'no_hp' => '081234567890',
                'paket_laundry_id' => 1,
                'berat' => 3.5,
                'total_harga' => 3.5 * 8000,
                'status' => 'antrean',
                'user_id' => $kasir->id,
            ],
            [
                'no_nota' => 'INV-0002',
                'nama_pelanggan' => 'Siti Aminah',
                'no_hp' => '081298765432',
                'paket_laundry_id' => 3,
                'berat' => 2,
                'total_harga' => 2 * 6000,
                'status' => 'dicuci',
                'user_id' => $kasir->id,
            ],
            [
                'no_nota' => 'INV-0003',
                'nama_pelanggan' => 'Andi Wijaya',
                'no_hp' => '081312345678',
                'paket_laundry_id' => 4,
                'berat' => 1.5,
                'total_harga' => 1.5 * 12000,
                'status' => 'siap_diambil',
                'user_id' => $kasir->id,
            ],
        ];

        foreach ($transaksis as $transaksi) {
            Transaksi::create($transaksi);
        }
    }
}
