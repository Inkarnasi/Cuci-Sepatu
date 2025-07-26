<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'address',
        'longitude',
        'latitude',
        'phone',
        'email',
        'opening_time',
        'closing_time',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'tiktok_url',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::count() > 0) {
                throw new \Exception("Hanya boleh ada satu store dalam tabel ini.");
            }

            $model->uuid = Str::uuid();
        });
    }
}
