<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LombaTable extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('lomba')) {
            Schema::create('lomba', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('buat_lomba_id');
                $table->foreign('buat_lomba_id')->references('id')->on('buat_lomba');
                $table->string('nama_kelas', 255);
                $table->integer('jumlah_pemain');
                $table->string('nama_peserta', 255);
                $table->string('jurusan', 255);
                $table->string('kontak', 20); // Assuming a maximum length of 20 for a phone number
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('lomba');
    }
}
