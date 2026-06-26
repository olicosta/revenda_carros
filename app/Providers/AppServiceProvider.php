<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $username = Str::lower((string) $request->input('username', 'visitante'));

            return Limit::perMinute(8)
                ->by($username.'|'.$request->ip())
                ->response(function (Request $request, array $headers) {
                    return back()
                        ->withHeaders($headers)
                        ->withErrors([
                            'username' => 'Muitas tentativas seguidas. Aguarde um minuto e tente novamente.',
                        ])
                        ->onlyInput('username');
                });
        });

        RateLimiter::for('customer-login', function (Request $request) {
            $cpf = preg_replace('/\D/', '', (string) $request->input('cpf', 'visitante'));

            return Limit::perMinute(12)
                ->by($cpf.'|'.$request->ip())
                ->response(function (Request $request, array $headers) {
                    return back()
                        ->withHeaders($headers)
                        ->withErrors([
                            'cpf' => 'Muitas consultas seguidas. Aguarde um minuto e tente novamente.',
                        ])
                        ->onlyInput('cpf');
                });
        });
    }
}
