<?php

use App\Models\StoreSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $setting = StoreSetting::query()->where('key', 'store')->first();

        if (! $setting) {
            return;
        }

        $value = $setting->value ?? [];
        $value['whatsapp'] = '+55 47 9620-7774';

        $setting->update(['value' => $value]);
    }

    public function down(): void
    {
        $setting = StoreSetting::query()->where('key', 'store')->first();

        if (! $setting) {
            return;
        }

        $value = $setting->value ?? [];

        if (($value['whatsapp'] ?? null) === '+55 47 9620-7774') {
            $value['whatsapp'] = '554796207774';
        }

        $setting->update(['value' => $value]);
    }
};
