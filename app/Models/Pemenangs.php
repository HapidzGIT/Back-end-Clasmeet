<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemenangs extends Model
{
    use HasFactory;

    protected $table = 'pemenangs'; // Tambahkan nama tabel yang sesuai

    protected $fillable = ['kelas_pemenang', 'jadwal_lomba_id'];

    public function jadwalLomba()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
