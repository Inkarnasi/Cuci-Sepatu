<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class transaksi_plus_service extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'qty',
        'note',
        'transaksi_id',
        'plus_service_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id');
    }
    public function plusService()
    {
        return $this->belongsTo(plus_service::class, 'plus_service_id');
    }
    
    public function categorySepatu()
    {
        return $this->belongsTo(CategorySepatu::class, 'category_sepatu_id');
    }

}
