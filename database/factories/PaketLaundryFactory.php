<?php

namespace Database\Factories;

use App\Models\PaketLaundry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PaketLaundry>
 */
class PaketLaundryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->words(2, true),
            'harga_per_kg' => fake()->randomElement([5000, 6000, 8000, 10000, 12000]),
            'satuan' => fake()->randomElement(['kg', 'pcs']),
        ];
    }
}
