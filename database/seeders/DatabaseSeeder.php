<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PaketLaundrySeeder::class,
            TransaksiSeeder::class,
        ]);

        // Generate additional random data using factories
        \App\Models\PaketLaundry::factory(5)->create();
        \App\Models\Transaksi::factory(20)->create();
    }
}
