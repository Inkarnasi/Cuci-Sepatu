<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class category_layanan extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'treatment_type', 'description','status_kategori_layanan'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'layanan_kategori_id');
    }
}
