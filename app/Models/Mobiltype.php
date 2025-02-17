<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobiltype extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [

        'name',
        'is_active'
    ];
}
