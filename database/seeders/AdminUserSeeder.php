<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['username' => env('ADMIN_USERNAME', 'admin')],
            [
                'name' => env('ADMIN_NAME', 'Administrador 3M'),
                'email' => env('ADMIN_EMAIL', 'admin@3mveiculos.local'),
                'password' => Hash::make(env('ADMIN_PASSWORD', '1234')),
            ]
        );
    }
}
