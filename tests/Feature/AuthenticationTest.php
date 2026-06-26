<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_to_login(): void
    {
        $this->get('/admin')
            ->assertRedirect('/login');
    }

    public function test_admin_can_login_with_username_and_password(): void
    {
        $user = User::query()->create([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'),
        ]);

        $this->post('/login', [
            'username' => 'admin',
            'password' => '1234',
        ])->assertRedirect('/admin');

        $this->assertAuthenticatedAs($user);
        $this->get('/admin')->assertOk();
    }

    public function test_invalid_credentials_return_to_login_with_error(): void
    {
        User::query()->create([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'),
        ]);

        $this->from('/login')
            ->post('/login', [
                'username' => 'admin',
                'password' => 'senha-incorreta',
            ])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('username');

        $this->assertGuest();
    }

    public function test_authenticated_admin_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/login');

        $this->assertGuest();
    }

    public function test_vehicle_writes_require_authentication(): void
    {
        $this->putJson('/api/vehicles/sync', ['vehicles' => []])
            ->assertUnauthorized();
    }

    public function test_admin_can_update_username_and_password(): void
    {
        $user = User::query()->create([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'),
        ]);

        $this->actingAs($user)
            ->putJson('/admin/credentials', [
                'current_username' => 'admin',
                'current_password' => '1234',
                'username' => 'gestor',
                'password' => 'nova-senha',
                'password_confirmation' => 'nova-senha',
            ])
            ->assertOk()
            ->assertJsonPath('message', 'Acesso atualizado com sucesso.');

        $user->refresh();

        $this->assertSame('gestor', $user->username);
        $this->assertTrue(Hash::check('nova-senha', $user->password));
    }
}
