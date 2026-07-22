<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerCommunicationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_record_customer_communication_and_it_is_audited(): void
    {
        $this->actingAs(User::factory()->create());
        $lead = Lead::query()->create(['name' => 'Cliente', 'status' => 'Novo']);

        $this->postJson('/api/leads/'.$lead->id.'/communications', [
            'channel' => 'WhatsApp',
            'direction' => 'Saída',
            'message' => 'Simulação enviada ao cliente.',
        ])->assertCreated();

        $this->assertDatabaseHas('customer_communications', [
            'lead_id' => $lead->id,
            'channel' => 'WhatsApp',
        ]);
        $this->assertDatabaseHas('audit_logs', [
            'method' => 'POST',
            'status' => 201,
        ]);
    }
}
