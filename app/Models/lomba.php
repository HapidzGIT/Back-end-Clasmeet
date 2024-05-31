<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    protected $table = 'lomba';
    protected $fillable = [
        'nama_lomba', // make sure if this is necessary
        'nama_kelas',
        'jumlah_pemain',
        'nama_peserta',
        'jurusan',
        'kontak',
        'buat_lomba_id',
        'user_id' // Make sure this column is added in migrations
    ];

    public function buatLomba()
    {

        return $this->belongsTo(buat_lomba::class, 'buat_lomba_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
