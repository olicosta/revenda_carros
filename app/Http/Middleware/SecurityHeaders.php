<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=()'
        );

        if ($this->isSensitivePath($request)) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, private');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }

        if (app()->isProduction() && $request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains'
            );
        }

        return $response;
    }

    private function isSensitivePath(Request $request): bool
    {
        return $request->is(
            'admin',
            'admin/*',
            'admin.html',
            'api/admin/*',
            'api/finance/*',
            'api/financing-applications*',
            'api/financing-documents/*',
            'api/leads*',
            'api/leads/*',
            'cliente',
            'cliente/*',
            'login',
            'login.html',
            'logout',
            'esqueci-senha',
            'redefinir-senha',
            'redefinir-senha/*',
            'financiamento-dados',
            'financiamento-dados.html'
        );
    }
}
