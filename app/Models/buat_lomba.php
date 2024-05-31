<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class buat_lomba extends Model
{
    protected $table = 'buat_lomba';
   protected $fillable = [
    'user_id',
    'nama_lomba',
    'image',
    'nama_pj',
    'kontak'
   ];

   public function Lomba(){
    return $this->hasMany(Lomba::class, 'buat_lomba_id');
   }
}
