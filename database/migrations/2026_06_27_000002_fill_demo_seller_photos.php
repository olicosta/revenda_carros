<?php

use App\Models\Seller;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $photos = [
            'Carlos Mendes' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=300&q=80',
            'Fernanda Lima' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=300&q=80',
            'Rafael Souza' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
            'Juliana Costa' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80',
            'Lucas Martins' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=300&q=80',
            'Mariana Alves' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80',
            'Bruno Rocha' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=300&q=80',
            'Patrícia Gomes' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=300&q=80',
            'Eduardo Santos' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
            'Camila Ribeiro' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=300&q=80',
        ];

        Seller::query()->whereIn('name', array_keys($photos))->each(function (Seller $seller) use ($photos) {
            $metadata = $seller->metadata ?? [];

            if (! empty($metadata['foto'])) {
                return;
            }

            $metadata['foto'] = $photos[$seller->name] ?? '';
            $seller->update(['metadata' => $metadata]);
        });
    }

    public function down(): void
    {
        // Mantém fotos já gravadas para não apagar uploads feitos pelo usuário.
    }
};
