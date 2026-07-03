<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $password = (string) env('ADMIN_PASSWORD', '1234');
        $username = (string) env('ADMIN_USERNAME', 'admin');
        $email = (string) env('ADMIN_EMAIL', 'admin@3mveiculos.local');

        if (app()->isProduction() && ($password === '1234' || strlen($password) < 12)) {
            throw ValidationException::withMessages([
                'ADMIN_PASSWORD' => 'Defina uma senha administrativa forte no .env antes de popular o banco em produção.',
            ]);
        }

        $user = User::query()
            ->where('username', $username)
            ->orWhere('email', $email)
            ->first() ?? new User;

        $user->fill([
            'username' => $username,
            'name' => env('ADMIN_NAME', 'Administrador 3M'),
            'role' => env('ADMIN_ROLE', 'gestor'),
            'email' => $email,
            'password' => Hash::make($password),
        ])->save();
    }
}
