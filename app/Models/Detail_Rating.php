<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Rating extends Model
{
    use HasFactory;
    protected $table = 'detail_rating';
    protected $primaryKey = 'id_detail_rating';
    public $incrementing = false;
    
    protected $fillable = [
        'id_detail_rating',
        'id_rating',
        'fasilitas',
        'kenyamanan',
        'harga',
        'letak',
    ];
}
