<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Администратор',
            'email' => 'admin@meridian.ru',
            'phone' => '+7 (999) 999-99-99',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
