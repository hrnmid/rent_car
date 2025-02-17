<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaksi_no',
        'mobil_id',
        'mobil_name',
        'mobil_merek',
        'mobil_type',
        'mobil_warna',
        'mobil_noplat',
        'mobil_biaya',
        'total_biaya',
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'customer_ktp',
        'customer_kecamatan',
        'customer_kelurahan',
        'customer_kodepos',
        'payment_status',
        'payment_jenis',
        'created_by',
        'is_active',
        'admin_staff_id',
        'booking_date',
        'jenis_sewa',
        'lama_sewa',
        'booking_end',
        'guarantee',
        'payment_mode',
        'booking_destination',
        'invoice_no',
        'invoice_date',
        'invoice_due',
        'bukti_path',
        'bukti_path2',
        'updated_at',
        'created_at',
    ];

    // public function statuses(): HasMany
    // {
    //     return $this->HasMany(ShipmentStatus::class, 'shipment_id', 'id')->orderBy('datetime', 'asc');
    // }

    // public function products(): HasMany
    // {
    //     return $this->HasMany(PreAlertsProducts::class, 'pre_alert_id', 'id');
    // }

    // public function vendors(): HasMany
    // {
    //     return $this->HasMany(PrealertVendor::class, 'pre_alert_id', 'id');
    // }

    // public function charges(): HasMany
    // {
    //     return $this->HasMany(ShippingCharges::class, 'pre_alert_id', 'id');
    // }

    // public function receipts(): HasMany
    // {
    //     return $this->HasMany(Receipt::class, 'pre_alert_id', 'receipt_id')->orderBy('receipt_id', 'asc');
    // }
}
