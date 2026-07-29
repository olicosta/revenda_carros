<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\StoreSetting;
use App\Models\Testimonial;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class RestoreSiteDataSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'id' => 1,
                'name' => 'Honda Civic Touring',
                'brand' => 'Honda',
                'model' => 'Civic Touring',
                'year' => 2020,
                'mileage' => 48000,
                'transmission' => 'Automático',
                'fuel' => 'Flex',
                'color' => 'Cinza',
                'sale_price' => 129900,
                'status' => 'Disponível',
                'featured' => true,
                'offer' => true,
                'description' => 'Sedan premium revisado, com excelente acabamento e procedência conferida.',
                'cover_image_path' => '/storage/vehicles/seed/honda-civic.jpg',
                'options' => ['Bancos em couro', 'Central multimídia', 'Câmera de ré'],
            ],
            [
                'id' => 2,
                'name' => 'Toyota Corolla XEi',
                'brand' => 'Toyota',
                'model' => 'Corolla XEi',
                'year' => 2021,
                'mileage' => 39000,
                'transmission' => 'Automático',
                'fuel' => 'Flex',
                'color' => 'Prata',
                'sale_price' => 135900,
                'status' => 'Disponível',
                'featured' => true,
                'offer' => false,
                'description' => 'Modelo reconhecido por conforto, manutenção acessível e ótima liquidez.',
                'cover_image_path' => '/storage/vehicles/seed/toyota-corolla.jpg',
                'options' => ['Piloto automático', 'Sensor de estacionamento', 'Ar digital'],
            ],
            [
                'id' => 3,
                'name' => 'Chevrolet Onix Premier',
                'brand' => 'Chevrolet',
                'model' => 'Onix Premier',
                'year' => 2022,
                'mileage' => 28000,
                'transmission' => 'Automático',
                'fuel' => 'Flex',
                'color' => 'Branco',
                'sale_price' => 89900,
                'status' => 'Disponível',
                'featured' => false,
                'offer' => false,
                'description' => 'Hatch completo, econômico e ideal para o dia a dia.',
                'cover_image_path' => '/storage/vehicles/seed/chevrolet-onix.jpg',
                'options' => ['Wi-Fi nativo', 'Chave presencial', 'MyLink'],
            ],
        ];

        foreach ($vehicles as $vehicle) {
            $legacy = [
                'id' => $vehicle['id'],
                'nome' => $vehicle['name'],
                'marca' => $vehicle['brand'],
                'modelo' => $vehicle['model'],
                'ano' => $vehicle['year'],
                'km' => number_format($vehicle['mileage'], 0, ',', '.').' km',
                'cambio' => $vehicle['transmission'],
                'combustivel' => $vehicle['fuel'],
                'cor' => $vehicle['color'],
                'tipo' => $vehicle['id'] === 3 ? 'Hatch' : 'Sedan',
                'status' => $vehicle['status'],
                'preco' => 'R$ '.number_format($vehicle['sale_price'], 0, ',', '.'),
                'imagem' => $vehicle['cover_image_path'],
                'galeria' => [$vehicle['cover_image_path']],
                'opcionais' => $vehicle['options'],
                'descricao' => $vehicle['description'],
                'destaque' => $vehicle['featured'],
                'oferta' => $vehicle['offer'],
            ];

            Vehicle::query()->updateOrCreate(
                ['id' => $vehicle['id']],
                [
                    ...$vehicle,
                    'gallery' => [$vehicle['cover_image_path']],
                    'metadata' => $legacy,
                ]
            );
        }

        $testimonials = [
            ['Marcos Silva', 'Toyota Corolla', 'Atendimento rápido e transparente.'],
            ['Ana Pereira', 'Chevrolet Onix', 'O carro estava exatamente como anunciado.'],
            ['Juliana Costa', 'Honda Civic', 'Equipe atenciosa e entrega muito organizada.'],
        ];

        foreach ($testimonials as $index => [$customer, $vehicle, $message]) {
            Testimonial::query()->updateOrCreate(
                ['id' => $index + 1],
                [
                    'customer_name' => $customer,
                    'vehicle' => $vehicle,
                    'rating' => 5,
                    'message' => $message,
                    'image_path' => '/img/logo-3m-veiculos.jpg',
                    'visible' => true,
                    'sort_order' => $index,
                ]
            );
        }

        foreach (['Santander', 'Bradesco', 'Itaú', 'Banco do Brasil', 'Caixa', 'BV Financeira'] as $index => $name) {
            Partner::query()->updateOrCreate(
                ['id' => $index + 1],
                ['name' => $name, 'visible' => true, 'sort_order' => $index]
            );
        }

        StoreSetting::query()->updateOrCreate(
            ['key' => 'store'],
            ['value' => [
                'nome' => '3M Veículos',
                'subtitulo' => 'Revenda de Veículos',
                'whatsapp' => '+55 47 9620-7774',
                'endereco' => 'CENTRO II - R. Campos Sáles, 293 - Vila Ferroviaria, Mafra - SC, 89300-094',
                'horario' => 'Segunda a sábado, das 8h às 18h',
                'instagram' => '@3mveiculos',
                'email' => 'contato@3mveiculos.com.br',
                'sobre' => 'Revenda multimarcas com veículos selecionados e negociação transparente.',
                'logo' => '/img/logo-3m-veiculos.jpg',
            ]]
        );
    }
}
