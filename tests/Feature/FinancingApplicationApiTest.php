<?php

namespace Tests\Feature;

use App\Models\FinancingApplication;
use App\Models\FinancingDocument;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FinancingApplicationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_submit_financing_application_and_create_lead(): void
    {
        $response = $this->postJson('/api/financing-applications', [
            'nome' => 'Maria Cliente',
            'cpf' => '123.456.789-00',
            'whatsapp' => '47999999999',
            'email' => 'maria@example.com',
            'veiculo' => 'Honda Civic',
            'valorVeiculo' => 'R$ 120.000',
            'entrada' => 'R$ 20.000',
            'prazo' => 48,
            'parcela' => 'R$ 2.800',
            'consentimento' => true,
            'dados' => ['full-profissao' => 'Analista'],
        ])->assertCreated()
            ->assertJsonPath('message', 'Solicitação recebida com sucesso.');

        $this->assertDatabaseHas('leads', [
            'cpf' => '123.456.789-00',
            'source' => 'Financiamento',
            'temperature' => 'Quente',
        ]);
        $this->assertDatabaseHas('financing_applications', [
            'cpf' => '123.456.789-00',
            'requested_amount' => 120000,
            'down_payment' => 20000,
            'installments' => 48,
        ]);

        Storage::fake('local');

        $this->post(
            '/api/financing-applications/'.$response->json('data.id').'/documents',
            [
                'token' => $response->json('data.upload_token'),
                'category' => 'Identificação',
                'documents' => [
                    UploadedFile::fake()->create(
                        'documento.pdf',
                        100,
                        'application/pdf'
                    ),
                ],
            ]
        )->assertCreated();

        $document = FinancingDocument::query()->firstOrFail();
        Storage::disk('local')->assertExists($document->path);
    }

    public function test_admin_can_list_and_update_analysis(): void
    {
        $this->actingAs(User::factory()->create());
        $lead = Lead::query()->create(['name' => 'Cliente', 'status' => 'Novo']);
        $application = FinancingApplication::query()->create([
            'lead_id' => $lead->id,
            'customer_name' => 'Cliente',
            'status' => 'Recebida',
            'form_data' => [],
        ]);

        $this->getJson('/api/financing-applications')
            ->assertOk()
            ->assertJsonCount(1, 'data');

        $this->putJson('/api/financing-applications/'.$application->id, [
            'status' => 'Aprovada',
            'institution' => 'Banco XPTO',
            'approved_amount' => 100000,
            'installments' => 48,
            'desired_installment' => 2500,
            'analysis_notes' => 'Crédito aprovado.',
        ])->assertOk()
            ->assertJsonPath('data.status', 'Aprovada');
    }

    public function test_financing_documents_are_not_public_storage_files(): void
    {
        $lead = Lead::query()->create(['name' => 'Cliente', 'status' => 'Novo']);
        $application = FinancingApplication::query()->create([
            'lead_id' => $lead->id,
            'customer_name' => 'Cliente',
            'status' => 'Recebida',
            'form_data' => [],
            'access_token' => hash('sha256', 'token-for-upload'),
        ]);

        $this->post('/api/financing-applications/'.$application->id.'/documents', [
            'token' => $application->access_token,
            'documents' => [
                \Illuminate\Http\UploadedFile::fake()->create('rg.pdf', 120, 'application/pdf'),
            ],
        ])->assertCreated();

        $document = $application->documents()->firstOrFail();

        $this->get('/storage/'.$document->path)
            ->assertNotFound();
    }
}
