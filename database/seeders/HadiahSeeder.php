<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HadiahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hadiahs')->insert([
            [
                'uuid' => Str::uuid(),
                'nama_hadiah' => 'Smartphone Samsung Galaxy A03',
                'deskripsi' => 'Smartphone Samsung Galaxy A03 terbaru dengan fitur lengkap',
                'jumlah' => 1,
                'tanggal_awal' => '2024-10-01', // Periode mulai dari 1 Oktober 2024
                'tanggal_akhir' => '2024-10-31', // Periode berakhir pada 31 Oktober 2024
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'nama_hadiah' => 'Laptop Asus ROG Strix',
                'deskripsi' => 'Laptop Asus ROG Strix terbaru dengan fitur lengkap',
                'jumlah' => 1,
                'tanggal_awal' => '2024-10-01', // Periode mulai dari 1 Oktober 2024
                'tanggal_akhir' => '2024-10-31', // Periode berakhir pada 31 Oktober 2024
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'nama_hadiah' => 'TWS Samsung Galaxy Buds 2',
                'deskripsi' => 'TWS Samsung Galaxy Buds 2 terbaru dengan fitur lengkap',
                'jumlah' => 2,
                'tanggal_awal' => '2024-10-01', // Periode mulai dari 1 Oktober 2024
                'tanggal_akhir' => '2024-10-31', // Periode berakhir pada 31 Oktober 2024
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'nama_hadiah' => 'TWS Samsung Galaxy Buds 4',
                'deskripsi' => 'TWS Samsung Galaxy Buds 4 terbaru dengan fitur lengkap',
                'jumlah' => 2,
                'tanggal_awal' => '2024-11-01', // Periode mulai dari 1 Oktober 2024
                'tanggal_akhir' => '2024-11-30', // Periode berakhir pada 31 Oktober 2024
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
