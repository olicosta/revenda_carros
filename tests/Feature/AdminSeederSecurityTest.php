<?php

namespace Tests\Feature;

use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AdminSeederSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_seeder_rejects_default_password_in_production(): void
    {
        App::detectEnvironment(fn () => 'production');
        Config::set('app.env', 'production');

        $this->expectException(ValidationException::class);

        $this->app->make(AdminUserSeeder::class)->run();
    }
}
