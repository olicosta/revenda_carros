<?php

use App\Models\StoreSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->mergeStoreSetting([
            'whatsapp' => '3012-3333',
            'endereco' => 'CENTRO II - R. Campos Sáles, 293 - Vila Ferroviaria, Mafra - SC, 89300-094',
        ]);
    }

    public function down(): void
    {
        $setting = StoreSetting::query()->where('key', 'store')->first();

        if (! $setting) {
            return;
        }

        $value = $setting->value ?? [];

        if (($value['whatsapp'] ?? null) === '3012-3333') {
            $value['whatsapp'] = '5547999999999';
        }

        if (($value['endereco'] ?? null) === 'CENTRO II - R. Campos Sáles, 293 - Vila Ferroviaria, Mafra - SC, 89300-094') {
            $value['endereco'] = 'Rua Principal, 100 - Centro';
        }

        $setting->update(['value' => $value]);
    }

    private function mergeStoreSetting(array $values): void
    {
        $setting = StoreSetting::query()->where('key', 'store')->first();

        if (! $setting) {
            return;
        }

        $setting->update([
            'value' => [
                ...($setting->value ?? []),
                ...$values,
            ],
        ]);
    }
};
