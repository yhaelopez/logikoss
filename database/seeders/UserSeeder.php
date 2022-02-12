<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'email' => 'yhaelopez@gmail.com',
            'name' => 'Yhael Lopez',
            'username' => 'yhaelopez',
            'password' => Hash::make('abcd1234'),
            'email_verified_at' => now()
        ]);
        $user->assignRole(['admin', 'editor']);
    }
}
