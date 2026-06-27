<?php

namespace Database\Seeders;

use App\Models\CustomerCommunication;
use App\Models\FinancialExpense;
use App\Models\FinancingApplication;
use App\Models\Lead;
use App\Models\Partner;
use App\Models\Seller;
use App\Models\Testimonial;
use App\Models\Vehicle;
use App\Models\VehicleHistory;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RestoreSiteDataSeeder::class);

        $vehicles = $this->vehicles();
        $sellers = $this->sellers();
        $leads = $this->leads($vehicles, $sellers);

        $this->expenses($vehicles, $sellers);
        $this->histories($vehicles);
        $this->financing($leads, $vehicles);
        $this->communications($leads);
        $this->testimonials();
        $this->partners();
    }

    private function vehicles(): array
    {
        $items = [
            ['Honda', 'Civic Touring', 2020, 48000, 129900, 'Cinza', 'Sedan', 'honda-civic.jpg'],
            ['Toyota', 'Corolla XEi', 2021, 39000, 135900, 'Prata', 'Sedan', 'toyota-corolla.jpg'],
            ['Chevrolet', 'Onix Premier', 2022, 28000, 89900, 'Branco', 'Hatch', 'chevrolet-onix.jpg'],
            ['Jeep', 'Compass Longitude', 2022, 35000, 149900, 'Preto', 'SUV', 'honda-civic.jpg'],
            ['Hyundai', 'Creta Platinum', 2023, 22000, 139900, 'Cinza', 'SUV', 'toyota-corolla.jpg'],
            ['Volkswagen', 'T-Cross Comfortline', 2021, 44000, 124900, 'Azul', 'SUV', 'chevrolet-onix.jpg'],
            ['Fiat', 'Toro Freedom', 2022, 51000, 134900, 'Vermelho', 'Pickup', 'honda-civic.jpg'],
            ['Nissan', 'Kicks Exclusive', 2023, 19000, 137900, 'Branco', 'SUV', 'toyota-corolla.jpg'],
            ['Renault', 'Duster Iconic', 2021, 47000, 104900, 'Prata', 'SUV', 'chevrolet-onix.jpg'],
            ['Ford', 'Ranger XLS', 2020, 68000, 159900, 'Preto', 'Pickup', 'honda-civic.jpg'],
        ];

        return collect($items)->map(function (array $item, int $index) {
            [$brand, $model, $year, $mileage, $price, $color, $type, $image] = $item;
            $id = $index + 1;
            $path = '/storage/vehicles/seed/'.$image;
            $legacy = [
                'id' => $id,
                'nome' => $brand.' '.$model,
                'marca' => $brand,
                'modelo' => $model,
                'ano' => $year,
                'km' => number_format($mileage, 0, ',', '.').' km',
                'cambio' => 'Automático',
                'combustivel' => 'Flex',
                'cor' => $color,
                'tipo' => $type,
                'status' => $index === 8 ? 'Reservado' : 'Disponível',
                'preco' => 'R$ '.number_format($price, 0, ',', '.'),
                'imagem' => $path,
                'galeria' => [$path],
                'opcionais' => ['Central multimídia', 'Câmera de ré', 'Controle de estabilidade'],
                'descricao' => 'Veículo de demonstração revisado e com procedência conferida.',
                'destaque' => $index < 4,
                'oferta' => in_array($index, [0, 4, 7], true),
                'dataEntrada' => now()->subDays(($index + 1) * 7)->format('Y-m-d'),
                'preparacaoStatus' => $index % 3 === 0 ? 'Em preparação' : 'Pronto para venda',
                'checklistAnuncio' => $index % 2 === 0 ? 'Completo' : 'Pendente',
            ];

            return Vehicle::query()->updateOrCreate(
                ['id' => $id],
                [
                    'name' => $legacy['nome'],
                    'brand' => $brand,
                    'model' => $model,
                    'year' => $year,
                    'mileage' => $mileage,
                    'transmission' => 'Automático',
                    'fuel' => 'Flex',
                    'color' => $color,
                    'purchase_price' => $price - 18000,
                    'sale_price' => $price,
                    'preparation_cost' => 1500 + ($index * 125),
                    'fees_cost' => 350,
                    'commission_rate' => 1.5,
                    'status' => $legacy['status'],
                    'featured' => $legacy['destaque'],
                    'offer' => $legacy['oferta'],
                    'description' => $legacy['descricao'],
                    'cover_image_path' => $path,
                    'gallery' => [$path],
                    'options' => $legacy['opcionais'],
                    'metadata' => $legacy,
                ]
            );
        })->all();
    }

    private function sellers(): array
    {
        $names = [
            'Carlos Mendes', 'Fernanda Lima', 'Rafael Souza', 'Juliana Costa',
            'Lucas Martins', 'Mariana Alves', 'Bruno Rocha', 'Patrícia Gomes',
            'Eduardo Santos', 'Camila Ribeiro',
        ];

        $photos = [
            'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
            'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80',
        ];

        return collect($names)->map(function (string $name, int $index) use ($photos) {
            $legacy = [
                'id' => $index + 1,
                'nome' => $name,
                'whatsapp' => '4799'.str_pad((string) (1000000 + $index), 7, '0', STR_PAD_LEFT),
                'email' => 'vendedor'.($index + 1).'@3mveiculos.local',
                'foto' => $photos[$index] ?? '',
                'ativo' => true,
                'comissaoTipo' => 'percentualVenda',
                'comissaoPadrao' => 0,
                'comissaoPercentualPadrao' => 1.5 + (($index % 3) * 0.25),
            ];

            return Seller::query()->updateOrCreate(
                ['email' => $legacy['email']],
                [
                    'name' => $name,
                    'phone' => $legacy['whatsapp'],
                    'status' => 'Ativo',
                    'commission_type' => 'percentualVenda',
                    'commission_default' => 0,
                    'commission_percentage' => $legacy['comissaoPercentualPadrao'],
                    'notes' => 'Vendedor de demonstração.',
                    'metadata' => $legacy,
                ]
            );
        })->all();
    }

    private function leads(array $vehicles, array $sellers): array
    {
        $names = [
            'Amanda Oliveira', 'Bruno Ferreira', 'Carla Rodrigues', 'Daniel Martins',
            'Elisa Fernandes', 'Felipe Almeida', 'Gabriela Souza', 'Henrique Lima',
            'Isabela Costa', 'João Ribeiro',
        ];
        $statuses = ['Novo', 'Em atendimento', 'Proposta', 'Em atendimento', 'Fechado', 'Novo', 'Proposta', 'Perdido', 'Em atendimento', 'Novo'];

        return collect($names)->map(function (string $name, int $index) use ($vehicles, $sellers, $statuses) {
            $vehicle = $vehicles[$index];
            $seller = $sellers[$index];
            $status = $statuses[$index];
            $email = 'cliente'.($index + 1).'@exemplo.com';
            $legacy = [
                'nome' => $name,
                'whatsapp' => '4798'.str_pad((string) (2000000 + $index), 7, '0', STR_PAD_LEFT),
                'email' => $email,
                'cpf' => sprintf('000.000.%03d-%02d', $index + 1, $index),
                'dataNascimento' => now()->subYears(24 + $index)->format('Y-m-d'),
                'cep' => '89000-'.str_pad((string) (100 + $index), 3, '0', STR_PAD_LEFT),
                'cidade' => $index % 2 === 0 ? 'Blumenau' : 'Itajaí',
                'estado' => 'SC',
                'profissao' => ['Analista', 'Empresário', 'Professora', 'Técnico', 'Autônoma'][$index % 5],
                'rendaMensal' => 4500 + ($index * 750),
                'veiculoId' => $vehicle->id,
                'veiculoNome' => $vehicle->name,
                'vendedorId' => $seller->id,
                'vendedorNome' => $seller->name,
                'origem' => ['Instagram', 'Site', 'WhatsApp', 'Indicação'][$index % 4],
                'status' => $status,
                'temperatura' => ['Morno', 'Quente', 'Quente', 'Frio'][$index % 4],
                'proximoContato' => now()->addDays($index - 3)->format('Y-m-d'),
                'tarefa' => $index % 2 === 0 ? 'Enviar nova simulação' : 'Confirmar visita à loja',
                'prazoTarefa' => now()->addDays($index - 2)->setTime(10, 0)->format('Y-m-d\TH:i'),
                'consentimento' => true,
                'observacao' => 'Cadastro demonstrativo para treinamento do painel.',
                'historico' => [[
                    'texto' => 'Primeiro atendimento realizado.',
                    'data' => now()->subDays($index + 1)->toISOString(),
                ]],
            ];

            return Lead::query()->updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'phone' => $legacy['whatsapp'],
                    'cpf' => $legacy['cpf'],
                    'birth_date' => $legacy['dataNascimento'],
                    'postal_code' => $legacy['cep'],
                    'city' => $legacy['cidade'],
                    'state' => 'SC',
                    'occupation' => $legacy['profissao'],
                    'monthly_income' => $legacy['rendaMensal'],
                    'vehicle_id' => $vehicle->id,
                    'seller_id' => $seller->id,
                    'source' => $legacy['origem'],
                    'status' => $status,
                    'temperature' => $legacy['temperatura'],
                    'loss_reason' => $status === 'Perdido' ? 'Comprou em outra loja' : null,
                    'task_title' => $legacy['tarefa'],
                    'task_due_at' => $legacy['prazoTarefa'],
                    'consent_at' => now()->subDays(10),
                    'next_contact_at' => $legacy['proximoContato'],
                    'last_interaction' => 'Primeiro atendimento realizado.',
                    'notes' => $legacy['observacao'],
                    'metadata' => $legacy,
                ]
            );
        })->all();
    }

    private function expenses(array $vehicles, array $sellers): void
    {
        $categories = ['Revisão', 'Marketing', 'Documentação', 'Limpeza', 'Combustível'];

        foreach (range(0, 9) as $index) {
            FinancialExpense::query()->updateOrCreate(
                ['description' => 'Despesa demonstrativa '.($index + 1)],
                [
                    'expense_date' => now()->subDays($index * 2)->format('Y-m-d'),
                    'category' => $categories[$index % count($categories)],
                    'amount' => 180 + ($index * 95),
                    'payment_method' => $index % 2 ? 'Pix' : 'Cartão',
                    'vehicle_id' => $vehicles[$index]->id,
                    'responsible' => $sellers[$index]->name,
                    'notes' => 'Lançamento para demonstração.',
                    'metadata' => ['demo' => true],
                ]
            );
        }
    }

    private function histories(array $vehicles): void
    {
        foreach ($vehicles as $index => $vehicle) {
            VehicleHistory::query()->updateOrCreate(
                [
                    'vehicle_id' => $vehicle->id,
                    'type' => 'Cadastro demonstrativo',
                ],
                [
                    'description' => 'Veículo incluído e conferido no estoque de demonstração.',
                    'metadata' => ['demo' => true, 'ordem' => $index + 1],
                ]
            );
        }
    }

    private function financing(array $leads, array $vehicles): void
    {
        $statuses = ['Recebida', 'Em análise', 'Aprovada', 'Documentação pendente', 'Recusada'];

        foreach ($leads as $index => $lead) {
            FinancingApplication::query()->updateOrCreate(
                ['lead_id' => $lead->id, 'vehicle_id' => $vehicles[$index]->id],
                [
                    'access_token' => hash('sha256', 'demo-'.$lead->id),
                    'protocol' => 'DEMO'.str_pad((string) ($index + 1), 6, '0', STR_PAD_LEFT),
                    'customer_name' => $lead->name,
                    'cpf' => $lead->cpf,
                    'phone' => $lead->phone,
                    'email' => $lead->email,
                    'status' => $statuses[$index % count($statuses)],
                    'institution' => $index % 2 === 0 ? 'Banco Demo' : null,
                    'requested_amount' => $vehicles[$index]->sale_price,
                    'down_payment' => 20000 + ($index * 1000),
                    'installments' => 48,
                    'desired_installment' => 2400 + ($index * 80),
                    'approved_amount' => $index % 5 === 2 ? $vehicles[$index]->sale_price - 20000 : null,
                    'terms' => ['demo' => true],
                    'form_data' => ['full-veiculo' => $vehicles[$index]->name],
                    'analysis_notes' => 'Solicitação demonstrativa.',
                    'consent_at' => now()->subDays($index),
                ]
            );
        }
    }

    private function communications(array $leads): void
    {
        foreach ($leads as $index => $lead) {
            CustomerCommunication::query()->updateOrCreate(
                ['lead_id' => $lead->id, 'message' => 'Contato demonstrativo '.($index + 1)],
                [
                    'user_id' => null,
                    'channel' => ['WhatsApp', 'Telefone', 'E-mail'][$index % 3],
                    'direction' => $index % 2 ? 'Entrada' : 'Saída',
                    'sent_at' => now()->subDays($index),
                ]
            );
        }
    }

    private function testimonials(): void
    {
        foreach (range(1, 10) as $index) {
            Testimonial::query()->updateOrCreate(
                ['id' => $index],
                [
                    'customer_name' => 'Cliente satisfeito '.$index,
                    'vehicle' => 'Veículo demonstrativo '.$index,
                    'rating' => 5,
                    'message' => 'Atendimento transparente e negociação muito tranquila.',
                    'image_path' => '/img/logo-3m-veiculos.jpg',
                    'visible' => true,
                    'sort_order' => $index,
                ]
            );
        }
    }

    private function partners(): void
    {
        $names = ['Santander', 'Bradesco', 'Itaú', 'Banco do Brasil', 'Caixa', 'BV Financeira', 'Sicoob', 'Sicredi', 'Banco Pan', 'Porto Bank'];

        foreach ($names as $index => $name) {
            Partner::query()->updateOrCreate(
                ['id' => $index + 1],
                ['name' => $name, 'visible' => true, 'sort_order' => $index]
            );
        }
    }
}
