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
        Schema::create('riwayat_daftar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peserta');
            $table->string('nama_kelas');
            $table->integer('jumlah_pemain');
            $table->string('jurusan');
            $table->string('kontak');
            $table->string('nama_lomba');
            $table->unsignedBigInteger('buat_lomba_id');
            $table->timestamps();
            $table->foreign('buat_lomba_id')->references('id')->on('lombas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_daftars');
    }
};
