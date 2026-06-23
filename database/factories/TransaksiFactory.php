<?php

namespace Database\Factories;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paket = \App\Models\PaketLaundry::inRandomOrder()->first() ?? \App\Models\PaketLaundry::factory()->create();
        $berat = fake()->randomFloat(1, 1, 10);

        return [
            'no_nota' => 'INV-' . fake()->unique()->numerify('######'),
            'nama_pelanggan' => fake()->name(),
            'no_hp' => fake()->phoneNumber(),
            'paket_laundry_id' => $paket->id,
            'berat' => $berat,
            'total_harga' => $berat * $paket->harga_per_kg,
            'status' => fake()->randomElement(['antrean', 'dicuci', 'disetrika', 'siap_diambil']),
            'user_id' => \App\Models\User::where('role', 'kasir')->inRandomOrder()->first()->id ?? \App\Models\User::factory()->create(['role' => 'kasir'])->id,
        ];
    }
}
