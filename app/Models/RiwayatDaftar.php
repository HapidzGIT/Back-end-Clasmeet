<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDaftar extends Model
{
    protected $table = 'riwayat_daftar';
    protected $fillable = [
        'user_id',
        'nama_lomba',
        'tanggal_daftar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
