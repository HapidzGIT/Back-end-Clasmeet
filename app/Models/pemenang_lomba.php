<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemenang_lomba extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lomba',
        'keterangan',
        'nama_kelas',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

