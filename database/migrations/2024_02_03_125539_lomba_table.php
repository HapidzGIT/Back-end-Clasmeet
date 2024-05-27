<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLombaTable extends Migration
{
    public function up()
    {
<<<<<<< HEAD
        Schema::create('lomba', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buat_lomba_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_kelas', 255);
            $table->integer('jumlah_pemain');
            $table->string('nama_peserta', 255);
            $table->string('jurusan', 255);
            $table->string('kontak', 20);
            $table->timestamps();

            $table->foreign('buat_lomba_id')->references('id')->on('buat_lomba');
            $table->foreign('user_id')->references('id')->on('users');
        });
=======
        if (!Schema::hasTable('lomba')) {
            Schema::create('lomba', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('buat_lomba_id');
                $table->foreign('buat_lomba_id')->references('id')->on('buat_lomba');
                $table->string('nama_kelas', 255);
                $table->integer('jumlah_pemain');
                $table->string('nama_peserta', 255);
                $table->string('jurusan', 255);
                $table->string('kontak', 20); 
                $table->timestamps();
            });
        }
>>>>>>> 0ab43ab0d16b8f4515c6ba5c402821b52375b367
    }

    public function down()
    {
        Schema::dropIfExists('lomba');
    }
}
