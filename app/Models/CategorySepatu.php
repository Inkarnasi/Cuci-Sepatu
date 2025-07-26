<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategorySepatu extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'category_sepatu'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function transaksis()
    {
        return $this->belongsToMany(transaksi::class, 'transaksi_category_hargas')
        ->withPivot('category_id', 'qty', 'uuid')
        ->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(category::class, 'transaksi_category_hargas')
        ->withPivot('transaksi_id', 'qty', 'uuid')
        ->withTimestamps();
    }

    public function plusServices()
    {
        return $this->belongsToMany(plus_service::class, 'transaksi_plus_services')
        ->withPivot('transaksi_id', 'uuid')
        ->withTimestamps();
    }
}
