<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'KASIR UTAMA FUTSAL',
            'email' => 'adminfutsal@gmail.com',
            'role' => 'admin', // Ini yang mengunci akses middleware
            'password' => Hash::make('adminfutsal123'), // Ganti password sesuai keinginan
        ]);
    }
}