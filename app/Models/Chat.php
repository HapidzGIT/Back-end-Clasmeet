<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    
    protected $table = 'chat';
    protected $fillable = ['user_id', 'message']; // Kolom-kolom yang dapat diisi

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tambahan relasi atau logika lainnya dapat ditambahkan di sini
}
