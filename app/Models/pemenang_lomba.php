<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//hdgsh
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
