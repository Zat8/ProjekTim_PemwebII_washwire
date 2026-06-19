<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaketLaundry;

class PaketLaundrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pakets = [
            ['nama' => 'Cuci Komplit', 'harga_per_kg' => 8000, 'satuan' => 'kg'],
            ['nama' => 'Cuci Kering', 'harga_per_kg' => 5000, 'satuan' => 'kg'],
            ['nama' => 'Setrika Saja', 'harga_per_kg' => 6000, 'satuan' => 'kg'],
            ['nama' => 'Cuci Kilat 24 Jam', 'harga_per_kg' => 12000, 'satuan' => 'kg'],
        ];

        foreach ($pakets as $paket) {
            PaketLaundry::create($paket);
        }
    }
}
