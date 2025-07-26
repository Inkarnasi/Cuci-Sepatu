<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Store::count() === 0) {
            Store::create([
                'uuid' => Str::uuid(),
                'name' => 'CUCISEPATU',
                'description' => 'Jasa Cuci Sepatu Modern & Profesional',
                'address' => 'Jl. IR. SUTAMI, ATAMBUA',
                'longitude' => 124.892494,
                'latitude' => -9.108398,
                'phone' => '+62 812 3456 7890',
                'email' => 'info@cucisepatu.com',
                'opening_time' => '08:00:00',
                'closing_time' => '21:00:00', // Replace with the actual Tiktok URL
            ]);
        }
    }
}
