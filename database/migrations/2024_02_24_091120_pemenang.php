<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** run guys
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemenang_lomba', function (Blueprint $table) {
            $table->id();
            $table->string("nama_lomba", 255)->default('');
            $table->string("image",255)->nullable(); // Mengubah menjadi nullable agar bisa null atau memberikan nilai default jika diperlukan
            $table->string("keterangan",255);
            $table->string("nama_kelas");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemenang_lomba');
    }
};
