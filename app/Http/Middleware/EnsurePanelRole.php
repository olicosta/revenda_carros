<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePanelRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! $user->hasPanelRole(...$roles)) {
            abort(403, 'Seu perfil não tem permissão para esta ação.');
        }

        return $next($request);
    }
}
