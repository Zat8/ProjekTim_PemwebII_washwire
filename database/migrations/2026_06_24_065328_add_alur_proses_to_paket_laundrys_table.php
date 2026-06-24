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
        Schema::table('paket_laundrys', function (Blueprint $table) {
            $table->string('alur_proses')->default('cuci_setrika');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket_laundrys', function (Blueprint $table) {
            $table->dropColumn('alur_proses');
        });
    }
};
