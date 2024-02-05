<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    protected $table = 'lomba';
    protected $fillable = [
        'nama_lomba',
        'nama_kelas',
        'jumlah_pemain',
        'nama_peserta',
        'jurusan',
        'kontak',
    ];
}
