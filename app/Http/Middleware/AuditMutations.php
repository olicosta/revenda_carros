<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditMutations
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            return $response;
        }

        $changes = $request->except([
            'password',
            'password_confirmation',
            'current_password',
            'token',
            'documents',
        ]);
        $routeParameters = collect($request->route()?->parameters() ?? [])
            ->map(fn ($value) => $value instanceof Model ? $value->getKey() : $value)
            ->all();

        AuditLog::query()->create([
            'user_id' => $request->user()?->id,
            'method' => $request->method(),
            'path' => '/'.$request->path(),
            'status' => $response->getStatusCode(),
            'ip_address' => $request->ip(),
            'changes' => $changes === [] ? null : [
                'fields' => array_keys($changes),
                'route_parameters' => $routeParameters,
            ],
        ]);

        return $response;
    }
}
