<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class transaksi_category_harga extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'qty',
        'transaksi_id',
        'category_id',
        'category_sepatu_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    
    
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
    
    public function categorySepatu()
    {
        return $this->belongsTo(CategorySepatu::class, 'category_sepatu_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id');
    }

    public function category_harga()
    {
        return $this->belongsTo(category::class);
    }


}
