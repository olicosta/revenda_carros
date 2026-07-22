<?php

namespace Tests\Feature;

use App\Models\FinancingApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_access_application_with_cpf_and_protocol(): void
    {
        $application = FinancingApplication::query()->create([
            'customer_name' => 'Cliente Portal',
            'cpf' => '123.456.789-00',
            'protocol' => 'ABC123TESTE',
            'status' => 'Em análise',
            'form_data' => [],
        ]);

        $this->post('/cliente/entrar', [
            'cpf' => $application->cpf,
            'protocol' => strtolower($application->protocol),
        ])->assertRedirect('/cliente');

        $this->get('/cliente')
            ->assertOk()
            ->assertSee('Cliente Portal')
            ->assertSee('Em análise');
    }

    public function test_customer_portal_rejects_invalid_protocol(): void
    {
        $this->from('/cliente')->post('/cliente/entrar', [
            'cpf' => '123.456.789-00',
            'protocol' => 'INVALIDO',
        ])->assertRedirect('/cliente')
            ->assertSessionHasErrors('cpf');
    }
}
