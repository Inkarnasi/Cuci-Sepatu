<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class promosi extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'nama_promosi',
        'start_date',
        'end_date',
        'status',
        'kode',
        'discount',
        'image',
        'description',
        'minimum_payment',
        'terms_conditions',
    ];

    // Jika Anda menggunakan tipe data tanggal, sebaiknya casting ke tipe date
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Definisikan relasi Many-to-One dengan Transaksi (Satu promosi dapat digunakan di banyak transaksi)
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    // Fungsi untuk memeriksa apakah promosi masih aktif berdasarkan tanggal
    public function isActive()
    {
        $today = now()->toDateString(); // Mengambil tanggal hari ini (tanpa jam)
        $startDate = $this->start_date->toDateString(); // Mengambil tanggal dari `start_date` (tanpa jam)
        $endDate = $this->end_date->toDateString(); // Mengambil tanggal dari `end_date` (tanpa jam)

        // Debugging, bisa dihapus jika tidak diperlukan
        // dd($today, $startDate, $endDate);

        return $this->status === 'active' && $startDate <= $today && $endDate >= $today;
    }

    public function isUpcoming()
    {
        $today = now()->toDateString(); // Mengambil tanggal hari ini (tanpa jam)
        $startDate = $this->start_date->toDateString(); // Mengambil tanggal dari `start_date` (tanpa jam)

        // Debugging, bisa dihapus jika tidak diperlukan
        // dd($today, $startDate);

        return $this->status === 'upcoming' && $startDate > $today;
    }

    public function isExpired()
    {
        $today = now()->toDateString(); // Mengambil tanggal hari ini (tanpa jam)
        $endDate = $this->end_date->toDateString(); // Mengambil tanggal dari `end_date` (tanpa jam)

        // Debugging, bisa dihapus setelah memastikan
        // dd($endDate, $today);

        return $this->status === 'expired' || $endDate < $today;
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
