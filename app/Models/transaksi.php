<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'status',
        'nama_customer',
        'notelp_customer',
        'promosi_id',
        'nama_admin_input',
        'total_harga',
        'tracking_number',
        'downpayment_amount',
        'remaining_payment',
        'tanggal_transaksi',
        'jam_transaksi',
        'user_id',
        'note',
        'status_downpayment',
        'pelunasan_amount',
        'status_pickup',
        'status_sepatu',
        'tanggal_pelunasan',
        'jam_pelunasan',
        'tanggal_pickup',
        'jam_pickup'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    // Relasi ke tracking_statuses (One-to-Many)
    public function trackingStatuses()
    {
        return $this->hasMany(tracking_status::class, 'transaksi_id');
    }


    // Relasi ke promosi (Many-to-One)
    public function promosi()
    {
        return $this->belongsTo(promosi::class);
    }

    public function karyawan()
    {
        return $this->belongsTo(User::class);
    }

    public function categoryHargas()
    {
        return $this->belongsToMany(category::class, 'transaksi_category_hargas', 'transaksi_id', 'category_id')
            ->withPivot('category_sepatu_id', 'qty', 'uuid')
            ->withTimestamps();
    }
    
public function categoryHargas1()
{
    return $this->hasMany(transaksi_category_harga::class, 'transaksi_id');
}

public function plusServices1()
{
    return $this->hasMany(transaksi_plus_service::class, 'transaksi_id');
}


    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plusServices()
    {
        return $this->belongsToMany(plus_service::class, 'transaksi_plus_services')
            ->withPivot('category_sepatu_id', 'uuid')
            ->withTimestamps();
    }
}
