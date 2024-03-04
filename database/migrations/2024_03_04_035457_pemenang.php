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
        Schema::create('pemenang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lomba_id'); // Menambah kolom untuk menyimpan ID lomba
            $table->foreign('lomba_id')->references('id')->on('lomba'); // Menetapkan kunci asing ke tabel lomba
            $table->string('kelas_pemenang'); // Hanya mengizinkan input kelas_pemenang
            // Jika Anda memerlukan kolom tambahan, tambahkan di sini
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemenang');
    }
};
