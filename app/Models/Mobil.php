<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'merek',
        'type',
        'warna',
        'tahun_produksi',
        'no_plat',
        'sewa_harian',
        'sewa_mingguan',
        'sewa_bulanan',
        'status',
        'is_active',
        'mobil_path',
    ];
}
