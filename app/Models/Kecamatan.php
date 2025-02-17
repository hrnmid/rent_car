<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [

        'name',
        'kode',
        'is_active'
    ];
}
