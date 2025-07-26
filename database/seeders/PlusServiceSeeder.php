<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlusServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plus_services')->insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Pewangi Sepatu',
                'price' => 10000,
                'status_plus_service' => 'active', // Status active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Pick Up & Delivery',
                'price' => 15000,
                'status_plus_service' => 'active', // Status active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Jahit',
                'price' => 40000,
                'status_plus_service' => 'active', // Status active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Pengecatan Tali Sepatu',
                'price' => 20000,
                'status_plus_service' => 'active', // Status active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Lapisan Anti Air',
                'price' => 25000,
                'status_plus_service' => 'active', // Status active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'Pembersihan Sole',
                'price' => 20000,
                'status_plus_service' => 'active', // Status active
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
