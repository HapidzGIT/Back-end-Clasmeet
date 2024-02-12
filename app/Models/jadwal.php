<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    protected $table = 'jadwal_lomba';
    protected $fillable = [
        'nama_lomba',
        'tanggal',
        'kelas',
        'tempat',
        'keterangan',
    ];
}
