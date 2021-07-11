<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rating';
    protected $primaryKey = 'id_rating';
    public $incrementing = false;
    
    protected $fillable = [
        'id_rating',
        'username',
        'id_hotel',
        'angka_rating',
    ];

    public function hotel()
    {
        return $this->belongsTo('App\Hotel', 'id_hotel');
    }

    public function user()
    {
        return $this->belongsTo('App\Hotel', 'useraname');
    }
}
