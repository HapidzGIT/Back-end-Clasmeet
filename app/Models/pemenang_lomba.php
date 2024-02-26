<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemenang_lomba extends Model
{
    protected $table = 'pemenang_lomba';
    protected $fillable = [
     'nama_lomba',
     'image',
     'keterangan',
     'nama_kelas'
    ];
}
