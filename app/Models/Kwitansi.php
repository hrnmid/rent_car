<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;
    // protected $table = 'receipts';
    protected $primaryKey = 'receipt_id';
    protected $fillable=[
        'receipt_no',
        'receipt_date',
        'transaksi_id',
        'receipt_method',
        'total_biaya',
        'receipt_status',
        'created_at',
        'updated_at',
    ];
}
