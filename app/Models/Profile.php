<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
