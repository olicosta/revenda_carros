<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PanelRoleAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_gestor_can_access_every_admin_api_area(): void
    {
        $user = User::factory()->create(['role' => 'gestor']);

        $this->actingAs($user)
            ->putJson('/api/vehicles/sync', ['vehicles' => []])
            ->assertOk();

        $this->actingAs($user)
            ->putJson('/api/leads/sync', ['leads' => []])
            ->assertOk();

        $this->actingAs($user)
            ->putJson('/api/finance/expenses/sync', ['expenses' => []])
            ->assertOk();
    }

    public function test_finance_profile_cannot_write_inventory(): void
    {
        $user = User::factory()->create(['role' => 'financeiro']);

        $this->actingAs($user)
            ->putJson('/api/vehicles/sync', ['vehicles' => []])
            ->assertForbidden();
    }

    public function test_sales_profile_can_manage_leads_but_not_finance(): void
    {
        $user = User::factory()->create(['role' => 'vendedor']);

        $this->actingAs($user)
            ->putJson('/api/leads/sync', ['leads' => []])
            ->assertOk();

        $this->actingAs($user)
            ->putJson('/api/finance/expenses/sync', ['expenses' => []])
            ->assertForbidden();
    }
}
