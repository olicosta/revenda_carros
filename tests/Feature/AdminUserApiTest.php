<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminUserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_gestor_can_create_update_and_delete_panel_users(): void
    {
        $gestor = User::factory()->create(['role' => 'gestor']);

        $response = $this->actingAs($gestor)->postJson('/api/admin/users', [
            'name' => 'Vendedor Teste',
            'username' => 'vendedor.teste',
            'email' => 'vendedor@example.com',
            'role' => 'vendedor',
            'password' => 'senha-segura-2026',
            'password_confirmation' => 'senha-segura-2026',
        ])->assertCreated();

        $userId = $response->json('data.id');
        $user = User::query()->findOrFail($userId);

        $this->assertSame('vendedor', $user->role);
        $this->assertTrue(Hash::check('senha-segura-2026', $user->password));

        $this->actingAs($gestor)->putJson('/api/admin/users/'.$userId, [
            'name' => 'Financeiro Teste',
            'username' => 'financeiro.teste',
            'email' => 'financeiro@example.com',
            'role' => 'financeiro',
            'password' => '',
            'password_confirmation' => '',
        ])->assertOk();

        $user->refresh();
        $this->assertSame('financeiro', $user->role);
        $this->assertTrue(Hash::check('senha-segura-2026', $user->password));

        $this->actingAs($gestor)
            ->deleteJson('/api/admin/users/'.$userId)
            ->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $userId]);
    }

    public function test_non_gestor_cannot_manage_panel_users(): void
    {
        $user = User::factory()->create(['role' => 'vendedor']);

        $this->actingAs($user)
            ->getJson('/api/admin/users')
            ->assertForbidden();
    }

    public function test_cannot_delete_the_last_gestor_or_own_account(): void
    {
        $gestor = User::factory()->create(['role' => 'gestor']);

        $this->actingAs($gestor)
            ->deleteJson('/api/admin/users/'.$gestor->id)
            ->assertUnprocessable();

        $other = User::factory()->create(['role' => 'vendedor']);

        $this->actingAs($gestor)
            ->putJson('/api/admin/users/'.$gestor->id, [
                'name' => $gestor->name,
                'username' => $gestor->username,
                'email' => $gestor->email,
                'role' => 'vendedor',
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertUnprocessable();

        $this->actingAs($gestor)
            ->deleteJson('/api/admin/users/'.$other->id)
            ->assertOk();
    }
}
