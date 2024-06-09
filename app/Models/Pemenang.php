<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemenang extends Model
{
    use HasFactory;

    protected $table = 'pemenang';

    protected $fillable = ['lomba_id', 'kelas_pemenang'];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }


}
