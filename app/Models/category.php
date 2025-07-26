<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class category extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'nama_kategori', 'price', 'description', 'estimation', 'layanan_kategori_id', 'status_kategori'];

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
            ->withPivot('category_sepatu_id', 'qty', 'uuid')
            ->withTimestamps();
    }


    public function categorySepatus()
    {
        return $this->belongsToMany(CategorySepatu::class, 'transaksi_category_hargas')
            ->withPivot('transaksi_id', 'qty', 'uuid')
            ->withTimestamps();
    }

    public function categoryLayanan()
    {
        return $this->belongsTo(category_layanan::class, 'layanan_kategori_id');
    }
        public function transaksiCategoryHargas()
    {
        return $this->hasMany(transaksi_category_harga::class, 'category_id');
    }
}
