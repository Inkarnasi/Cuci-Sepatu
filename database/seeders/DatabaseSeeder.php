<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PromosiSeeder::class,
            PlusServiceSeeder::class,
            CategorySeeder::class,
            UsersSeeder::class,
            CategoryBlogSeeder::class,
            HadiahSeeder::class,
            StoreSeeder::class
        ]);
    }
}
