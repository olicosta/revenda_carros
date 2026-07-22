<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'id' => 1, 'marca' => 'Honda', 'modelo' => 'Civic Touring',
                'nome' => 'Honda Civic Touring', 'ano' => 2020, 'km' => '48.000 km',
                'cambio' => 'Automático', 'combustivel' => 'Flex', 'cor' => 'Cinza',
                'tipo' => 'Sedan', 'status' => 'Disponível', 'portas' => 4,
                'placaFinal' => '7', 'blindado' => false, 'destaque' => true,
                'descricao' => 'Sedan premium revisado, com excelente acabamento, tecnologia embarcada e procedência conferida.',
                'opcionais' => ['Bancos em couro', 'Central multimídia', 'Câmera de ré', 'Controle de estabilidade'],
                'preco' => 'R$ 129.900', 'oferta' => true,
                'imagem' => 'https://images.unsplash.com/photo-1606016159991-dfe4f2746ad5?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'id' => 2, 'marca' => 'Toyota', 'modelo' => 'Corolla XEi',
                'nome' => 'Toyota Corolla XEi', 'ano' => 2021, 'km' => '39.000 km',
                'cambio' => 'Automático', 'combustivel' => 'Flex', 'cor' => 'Prata',
                'tipo' => 'Sedan', 'status' => 'Disponível', 'portas' => 4,
                'placaFinal' => '3', 'blindado' => false, 'destaque' => true,
                'descricao' => 'Modelo reconhecido por conforto, baixo custo de manutenção e ótima liquidez no mercado.',
                'opcionais' => ['Piloto automático', 'Sensor de estacionamento', 'Ar digital', 'Rodas de liga leve'],
                'preco' => 'R$ 135.900', 'oferta' => false,
                'imagem' => 'https://images.unsplash.com/photo-1619767886558-efdc259cde1a?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'id' => 3, 'marca' => 'Chevrolet', 'modelo' => 'Onix Premier',
                'nome' => 'Chevrolet Onix Premier', 'ano' => 2022, 'km' => '28.000 km',
                'cambio' => 'Automático', 'combustivel' => 'Flex', 'cor' => 'Branco',
                'tipo' => 'Hatch', 'status' => 'Disponível', 'portas' => 4,
                'placaFinal' => '9', 'blindado' => false, 'destaque' => false,
                'descricao' => 'Hatch completo, econômico e ideal para quem busca praticidade no dia a dia.',
                'opcionais' => ['Wi-Fi nativo', 'Chave presencial', 'Alerta de ponto cego', 'MyLink'],
                'preco' => 'R$ 89.900', 'oferta' => false,
                'imagem' => 'https://images.unsplash.com/photo-1549927681-0b673b8243ab?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        foreach ($vehicles as $legacy) {
            Vehicle::query()->updateOrCreate(
                ['id' => $legacy['id']],
                [
                    'name' => $legacy['nome'],
                    'brand' => $legacy['marca'],
                    'model' => $legacy['modelo'],
                    'year' => $legacy['ano'],
                    'mileage' => (int) preg_replace('/\D+/', '', $legacy['km']),
                    'transmission' => $legacy['cambio'],
                    'fuel' => $legacy['combustivel'],
                    'color' => $legacy['cor'],
                    'sale_price' => (int) preg_replace('/\D+/', '', $legacy['preco']),
                    'status' => $legacy['status'],
                    'featured' => $legacy['destaque'],
                    'offer' => $legacy['oferta'],
                    'description' => $legacy['descricao'],
                    'cover_image_path' => $legacy['imagem'],
                    'gallery' => [$legacy['imagem']],
                    'options' => $legacy['opcionais'],
                    'metadata' => array_merge($legacy, ['galeria' => [$legacy['imagem']]]),
                ]
            );
        }
    }
}
