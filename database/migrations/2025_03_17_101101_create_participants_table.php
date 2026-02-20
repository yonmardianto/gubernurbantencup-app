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
            $table->date('tgl_lahir')->nullable();
            $table->enum('gender', ['Putra', 'Putri']);
            $table->string('club');
            $table->enum('kategori', ['Pemula', 'Prestasi']);
            $table->string('kategori_level');
            $table->enum('kategori_tanding', ['POOMSAE', 'KYORUGI']);
            $table->enum('kelompok_poomsae', ['Individu-Putra', 'Individu-Putri', 'Pair', 'Beregu', 'Freestyle'])->nullable();
            $table->enum('sabuk_poomsae', ['PUTIH', 'KUNING', 'KUNING-STRIP', 'HIJAU', 'HIJAU-STRIP', 'BIRU', 'BIRU-STRIP', 'MERAH'])->nullable();
            $table->enum('sabuk_kyorugi', ['PUTIH', 'KUNING', 'KUNING-STRIP', 'HIJAU', 'HIJAU-STRIP', 'BIRU', 'BIRU-STRIP', 'MERAH'])->nullable();
            $table->enum('kategori_usia', ['4-5th', '6-7th', '8-9th', '10-11th'])->nullable();
            $table->string('berat_badan')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->string('pembayaran')->nullable();
            $table->foreignId('manager_id')->constrained('users');
            $table->unsignedBigInteger('updated_by');
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
