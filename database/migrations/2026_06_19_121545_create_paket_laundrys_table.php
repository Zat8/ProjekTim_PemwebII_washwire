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
        Schema::create('paket_laundrys', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // contoh: Cuci Komplit, Setrika Saja
            $table->decimal('harga_per_kg', 10, 2);
            $table->string('satuan')->default('kg'); // kg atau item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_laundrys');
    }
};
