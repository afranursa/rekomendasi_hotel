<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'username';
    public $incrementing = false;
    
    protected $fillable = [
        'username',
        'password',
        'nama_user',
        'jk',
        'no_hp',
        'alamat'
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
      $this->attributes['password'] = bcrypt($value);
    }

    public function hotel() {
        return $this->hasMany('App\Models\Rating', 'username');
    }
}
