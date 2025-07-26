<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password123'), // Make sure to hash the password
            'role' => 'superadmin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert a karyawan 1
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Ache',
            'email' => 'ache@gmail.com',
            'password' => Hash::make('password123'), // Make sure to hash the password
            'role' => 'karyawan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Melati',
            'email' => 'melati@gmail.com',
            'password' => Hash::make('password123'), // Make sure to hash the password
            'role' => 'karyawan2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Bela',
            'email' => 'bela@gmail.com',
            'password' => Hash::make('password123'), // Make sure to hash the password
            'role' => 'karyawan3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Rista',
            'email' => 'rista@gmail.com',
            'password' => Hash::make('password123'), // Make sure to hash the password
            'role' => 'karyawan4',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Amel',
            'email' => 'amel@gmail.com',
            'password' => Hash::make('password123'), // Make sure to hash the password
            'role' => 'karyawan5',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'uuid' => Str::uuid(),
            'name' => 'Putri',
            'email' => 'putri@gmail.com',
            'password' => Hash::make('password123'), // Make sure to hash the password
            'role' => 'karyawan6',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
