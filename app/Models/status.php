<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class status extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'name'];

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
        return $this->hasMany(tracking_status::class);
    }
}
