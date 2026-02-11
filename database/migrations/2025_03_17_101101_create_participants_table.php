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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->enum('gender', ['Putra', 'Putri']);
            $table->string('club');
            $table->enum('kategori', ['Pemula', 'Prestasi']);
            $table->enum('kategori_level', ['PRACADET', 'CADET', 'JUNIOR', 'SENIOR']);
            $table->enum('kategori_tanding', ['POOMSAE', 'KYORUGI']);
            $table->enum('kelompok_poomsae', ['Individu-Putra', 'Individu-Putri', 'Pair', 'Beregu'])->nullable();
            $table->enum('sabuk_poomsae', ['KUNING/KUNING-STRIP', 'HIJAU/HIJAU-STRIP', 'BIRU/MERAH'])->nullable();
            $table->enum('kategori_usia', ['4-5th', '6-7th', '8-9th', '10-11th'])->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
