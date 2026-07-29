<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\CustomerPortalController;
use Illuminate\Support\Facades\Route;

$publicPages = [
    '/' => 'index',
    '/index.html' => 'index',
    '/veiculos' => 'carros',
    '/carros.html' => 'carros',
    '/sobre' => 'sobre',
    '/sobre.html' => 'sobre',
    '/depoimentos' => 'depoimentos',
    '/depoimentos.html' => 'depoimentos',
    '/financiamento' => 'financiamento',
    '/financiamento.html' => 'financiamento',
    '/financiamento-dados' => 'financiamento-dados',
    '/financiamento-dados.html' => 'financiamento-dados',
    '/detalhes' => 'detalhes',
    '/detalhes.html' => 'detalhes',
    '/politica-privacidade' => 'politica-privacidade',
    '/politica-privacidade.html' => 'politica-privacidade',
    '/termos-de-uso' => 'termos-de-uso',
    '/termos-de-uso.html' => 'termos-de-uso',
];

foreach ($publicPages as $uri => $view) {
    Route::view($uri, 'site.'.$view);
}

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::get('/login.html', [AuthenticatedSessionController::class, 'create']);
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('throttle:login')
    ->name('login.store');
Route::get('/esqueci-senha', [PasswordResetController::class, 'request'])
    ->name('password.request');
Route::post('/esqueci-senha', [PasswordResetController::class, 'email'])
    ->middleware('throttle:3,1')
    ->name('password.email');
Route::get('/redefinir-senha/{token}', [PasswordResetController::class, 'reset'])
    ->name('password.reset');
Route::post('/redefinir-senha', [PasswordResetController::class, 'update'])
    ->middleware('throttle:5,1')
    ->name('password.update');

Route::get('/cliente', [CustomerPortalController::class, 'show'])
    ->name('customer.portal');
Route::post('/cliente/entrar', [CustomerPortalController::class, 'login'])
    ->middleware('throttle:customer-login')
    ->name('customer.login');
Route::post('/cliente/sair', [CustomerPortalController::class, 'logout'])
    ->name('customer.logout');

Route::middleware('auth')->group(function () {
    Route::view('/admin', 'site.admin')->name('admin');
    Route::view('/admin.html', 'site.admin');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::put('/admin/credentials', [AuthenticatedSessionController::class, 'updateCredentials'])
        ->name('admin.credentials.update');
});
