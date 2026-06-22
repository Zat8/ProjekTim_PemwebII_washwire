<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin WashWire',
            'email' => 'admin@washwire.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Satu',
            'email' => 'kasir@washwire.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'pelanggan@washwire.com',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
            'no_hp' => '081234567890',
        ]);
    }
}