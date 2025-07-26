<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tracking_status extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'transaksi_id',
        'status_id',
        'description',
        'tanggal_status',
        'jam_status',
        'note',
        'role'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }


        public function status()
    {
        return $this->belongsTo(status::class, 'status_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class, 'transaksi_id');
    }
}
