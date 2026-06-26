<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\StoreSetting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['Marcos Silva', 'Toyota Corolla', 'Atendimento rápido e transparente. Consegui simular o financiamento e fechar negócio no mesmo dia.', 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=700&q=80'],
            ['Ana Pereira', 'Chevrolet Onix', 'Gostei muito da clareza nas informações. O carro estava exatamente como anunciado.', 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=700&q=80'],
            ['Rafael Souza', 'Toyota Hilux', 'Processo simples, equipe atenciosa e negociação muito prática pelo WhatsApp.', 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=700&q=80'],
            ['Juliana Costa', 'Honda Civic', 'Equipe muito atenciosa do início ao fim. A entrega foi organizada e o carro estava impecável.', 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=700&q=80'],
            ['Bruno Almeida', 'Jeep Compass', 'Gostei da agilidade na negociação e da transparência nas informações do veículo.', 'https://images.unsplash.com/photo-1556745757-8d76bdb6984b?auto=format&fit=crop&w=700&q=80'],
            ['Camila Rocha', 'Hyundai Creta', 'Fui bem atendida, consegui simular o financiamento e saí com tudo resolvido.', 'https://images.unsplash.com/photo-1551836022-4c4c79ecde51?auto=format&fit=crop&w=700&q=80'],
        ];

        foreach ($testimonials as $index => [$customer, $vehicle, $message, $image]) {
            Testimonial::query()->firstOrCreate(
                ['id' => $index + 1],
                [
                    'customer_name' => $customer,
                    'vehicle' => $vehicle,
                    'rating' => 5,
                    'message' => $message,
                    'image_path' => $image,
                    'visible' => true,
                    'sort_order' => $index,
                ]
            );
        }

        foreach (['Santander', 'Bradesco', 'Itau', 'Banco do Brasil', 'Caixa', 'BV Financeira'] as $index => $name) {
            Partner::query()->firstOrCreate(
                ['id' => $index + 1],
                [
                    'name' => $name,
                    'visible' => true,
                    'sort_order' => $index,
                ]
            );
        }

        StoreSetting::query()->firstOrCreate(
            ['key' => 'store'],
            ['value' => [
                'nome' => '3M Veículos',
                'subtitulo' => 'Revenda de Veículos',
                'whatsapp' => '5547999999999',
                'endereco' => 'Rua Principal, 100 - Centro',
                'horario' => 'Segunda a sábado, das 8h às 18h',
                'instagram' => '@3mveiculos',
                'email' => 'contato@3mveiculos.com.br',
                'sobre' => 'Somos uma revenda multimarcas focada em veículos selecionados, atendimento direto e negociação transparente do primeiro contato até a entrega.',
                'logo' => 'img/logo-3m-veiculos.jpg',
                'mensagemVeiculo' => "Olá, tenho interesse neste veículo:\n\nModelo: {nome}\nAno: {ano}\nKm: {km}\nCâmbio: {cambio}\nTipo: {tipo}\nCor: {cor}\nCombustível: {combustivel}\nPreço: {preco}\nStatus: {status}",
            ]]
        );
    }
}
