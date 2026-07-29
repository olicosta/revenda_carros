<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    public function test_public_responses_include_security_headers(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('X-Permitted-Cross-Domain-Policies', 'none')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('Cross-Origin-Opener-Policy', 'same-origin')
            ->assertHeader(
                'Permissions-Policy',
                'camera=(), microphone=(), geolocation=(), payment=()'
            );
    }

    public function test_sensitive_responses_are_not_stored_by_browser_cache(): void
    {
        $response = $this->get('/login')
            ->assertOk()
            ->assertHeader('Pragma', 'no-cache')
            ->assertHeader('Expires', '0');

        $cacheControl = $response->headers->get('Cache-Control', '');

        foreach (['no-store', 'no-cache', 'must-revalidate', 'private'] as $directive) {
            $this->assertStringContainsString($directive, $cacheControl);
        }
    }
}
