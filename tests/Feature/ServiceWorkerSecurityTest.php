<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServiceWorkerSecurityTest extends TestCase
{
    public function test_service_worker_does_not_cache_private_routes(): void
    {
        $serviceWorker = file_get_contents(public_path('service-worker.js'));

        $this->assertStringContainsString('PRIVATE_PREFIXES', $serviceWorker);
        $this->assertStringContainsString('"/admin"', $serviceWorker);
        $this->assertStringContainsString('"/api/"', $serviceWorker);
        $this->assertStringContainsString('"/cliente"', $serviceWorker);
        $this->assertStringContainsString('"/storage/financing"', $serviceWorker);
        $this->assertStringContainsString('if (!shouldCache(event.request)) return;', $serviceWorker);
    }
}
