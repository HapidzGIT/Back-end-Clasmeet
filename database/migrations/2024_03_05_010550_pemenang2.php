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
        Schema::create('pemenangs', function (Blueprint $table) {
            $table->id();
            $table->string('kelas_pemenang');
            $table->unsignedBigInteger('jadwal_lomba_id'); // tambahkan kolom foreign key
            $table->foreign('jadwal_lomba_id')->references('id')->on('jadwal_lomba')->onDelete('cascade'); // definisikan foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemenangs');
    }
};

//hsdgshd
