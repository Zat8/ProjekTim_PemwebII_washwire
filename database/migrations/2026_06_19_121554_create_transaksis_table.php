<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->unique();
            $table->string('nama_pelanggan');
            $table->string('no_hp')->nullable();
            $table->foreignId('paket_laundry_id')->constrained('paket_laundrys')->onDelete('cascade');
            $table->decimal('berat', 8, 2); // dalam kg
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['antrean', 'dicuci', 'disetrika', 'siap_diambil'])->default('antrean');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // kasir yang input
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
