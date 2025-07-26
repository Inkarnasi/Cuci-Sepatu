<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class qrcodes extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'transaksi_id', 'category_sepatu', 'role', 'qrcode', 'code', 'create_code_date', 'create_code_time'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
