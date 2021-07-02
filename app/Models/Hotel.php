<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotel';
    protected $primaryKey = 'id_hotel';
    public $incrementing = false;
    
    protected $fillable = [
        'nama_hotel',
        'jenis_hotel',
        'kota',
    ];
}
