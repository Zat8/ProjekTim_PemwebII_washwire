<?php

namespace Tests\Feature;

use App\Models\PaketLaundry;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransaksiStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaksi_status_sequences_for_different_packages()
    {
        $user = User::factory()->create();

        // 1. Cuci Saja
        $paketCuciSaja = PaketLaundry::create([
            'nama' => 'Cuci Kering',
            'harga_per_kg' => 5000,
            'satuan' => 'kg',
            'alur_proses' => 'cuci_saja',
        ]);

        $transaksiCuciSaja = Transaksi::create([
            'no_nota' => 'INV-0001',
            'nama_pelanggan' => 'Pelanggan 1',
            'paket_laundry_id' => $paketCuciSaja->id,
            'berat' => 2,
            'total_harga' => 10000,
            'status' => 'antrean',
            'user_id' => $user->id,
        ]);

        $this->assertEquals(['antrean', 'dicuci', 'siap_diambil'], $transaksiCuciSaja->statusUrutan());
        $this->assertEquals('dicuci', $transaksiCuciSaja->statusBerikutnya());

        $transaksiCuciSaja->status = 'dicuci';
        $this->assertEquals('siap_diambil', $transaksiCuciSaja->statusBerikutnya());

        $transaksiCuciSaja->status = 'siap_diambil';
        $this->assertNull($transaksiCuciSaja->statusBerikutnya());

        // 2. Setrika Saja
        $paketSetrikaSaja = PaketLaundry::create([
            'nama' => 'Setrika Saja',
            'harga_per_kg' => 6000,
            'satuan' => 'kg',
            'alur_proses' => 'setrika_saja',
        ]);

        $transaksiSetrikaSaja = Transaksi::create([
            'no_nota' => 'INV-0002',
            'nama_pelanggan' => 'Pelanggan 2',
            'paket_laundry_id' => $paketSetrikaSaja->id,
            'berat' => 2,
            'total_harga' => 12000,
            'status' => 'antrean',
            'user_id' => $user->id,
        ]);

        $this->assertEquals(['antrean', 'disetrika', 'siap_diambil'], $transaksiSetrikaSaja->statusUrutan());
        $this->assertEquals('disetrika', $transaksiSetrikaSaja->statusBerikutnya());

        $transaksiSetrikaSaja->status = 'disetrika';
        $this->assertEquals('siap_diambil', $transaksiSetrikaSaja->statusBerikutnya());

        // 3. Cuci Setrika (Cuci Komplit)
        $paketCuciSetrika = PaketLaundry::create([
            'nama' => 'Cuci Komplit',
            'harga_per_kg' => 8000,
            'satuan' => 'kg',
            'alur_proses' => 'cuci_setrika',
        ]);

        $transaksiCuciSetrika = Transaksi::create([
            'no_nota' => 'INV-0003',
            'nama_pelanggan' => 'Pelanggan 3',
            'paket_laundry_id' => $paketCuciSetrika->id,
            'berat' => 2,
            'total_harga' => 16000,
            'status' => 'antrean',
            'user_id' => $user->id,
        ]);

        $this->assertEquals(['antrean', 'dicuci', 'disetrika', 'siap_diambil'], $transaksiCuciSetrika->statusUrutan());
        $this->assertEquals('dicuci', $transaksiCuciSetrika->statusBerikutnya());

        $transaksiCuciSetrika->status = 'dicuci';
        $this->assertEquals('disetrika', $transaksiCuciSetrika->statusBerikutnya());

        $transaksiCuciSetrika->status = 'disetrika';
        $this->assertEquals('siap_diambil', $transaksiCuciSetrika->statusBerikutnya());
    }
}
