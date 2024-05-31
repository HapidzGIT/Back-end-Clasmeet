<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = 'riwayat';

    protected $fillable = [
        'buat_lomba_id',
        'nama_kelas_id',
        'jumlah_pemain_id',
        'nama_peserta_id',
        'jurusan_id',
    ];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class, 'buat_lomba_id');
    }

    public function namaKelas()
    {
        return $this->belongsTo(Lomba::class, 'nama_kelas_id');
    }

    public function jumlahPemain()
    {
        return $this->belongsTo(Lomba::class, 'jumlah_pemain_id');
    }

    public function namaPeserta()
    {
        return $this->belongsTo(Lomba::class, 'nama_peserta_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Lomba::class, 'jurusan_id');
    }
}
