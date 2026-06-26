<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLoginSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_with_default_credentials(): void
    {
        User::query()->updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrador 3M',
                'email' => 'admin@3mveiculos.local',
                'password' => Hash::make('1234'),
            ],
        );

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => '1234',
        ]);

        $response->assertRedirect(route('admin'));
        $this->assertAuthenticated();
    }
}
