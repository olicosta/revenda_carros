<?php

use App\Http\Controllers\Api\CustomerCommunicationController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\FinanceDataController;
use App\Http\Controllers\Api\FinancingApplicationController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\OperationsController;
use App\Http\Controllers\Api\SiteContentController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Middleware\AuditMutations;
use Illuminate\Support\Facades\Route;

Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/site/bootstrap', [VehicleController::class, 'bootstrap']);
Route::get('/site/testimonials', [SiteContentController::class, 'testimonials']);
Route::get('/site/partners', [SiteContentController::class, 'partners']);
Route::get('/site/settings', [SiteContentController::class, 'settings']);
Route::middleware('throttle:120,1')->group(function () {
    Route::post('/analytics/visits', [OperationsController::class, 'recordVisit']);
    Route::put('/analytics/visits/{externalId}', [OperationsController::class, 'updateVisit']);
});
Route::post('/financing-applications', [FinancingApplicationController::class, 'store'])
    ->middleware('throttle:10,1');
Route::post(
    '/financing-applications/{application}/documents',
    [FinancingApplicationController::class, 'uploadDocuments']
)->middleware('throttle:20,1');

Route::middleware(['web', 'auth', AuditMutations::class])->group(function () {
    Route::middleware('panel.role:estoque')->group(function () {
        Route::post('/vehicles', [VehicleController::class, 'store']);
        Route::put('/vehicles/sync', [VehicleController::class, 'sync']);
        Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update']);
        Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy']);
        Route::get('/vehicle-histories', [OperationsController::class, 'histories']);
        Route::put('/vehicle-histories/sync', [OperationsController::class, 'syncHistories']);
    });

    Route::middleware('panel.role:financeiro')->group(function () {
        Route::get('/finance/summary', [FinanceDataController::class, 'summary']);
        Route::get('/finance/accounts', [FinanceDataController::class, 'accounts']);
        Route::get('/finance/categories', [FinanceDataController::class, 'categories']);
        Route::get('/finance/entries', [FinanceDataController::class, 'entries']);
        Route::post('/finance/entries', [FinanceDataController::class, 'storeEntry']);
        Route::put('/finance/entries/{entry}', [FinanceDataController::class, 'updateEntry']);
        Route::post('/finance/entries/{entry}/settle', [FinanceDataController::class, 'settleEntry']);
        Route::post('/finance/entries/{entry}/cancel', [FinanceDataController::class, 'cancelEntry']);
        Route::get('/finance/vehicles/{vehicle}', [FinanceDataController::class, 'vehicleFinance']);
        Route::get('/finance/expenses', [FinanceDataController::class, 'expenses']);
        Route::post('/finance/expenses', [FinanceDataController::class, 'storeExpense']);
        Route::put('/finance/expenses/sync', [FinanceDataController::class, 'syncExpenses']);
        Route::put('/finance/expenses/{expense}', [FinanceDataController::class, 'updateExpense']);
        Route::delete('/finance/expenses/{expense}', [FinanceDataController::class, 'destroyExpense']);
        Route::get('/finance/sellers', [FinanceDataController::class, 'sellers']);
        Route::post('/finance/sellers', [FinanceDataController::class, 'storeSeller']);
        Route::put('/finance/sellers/sync', [FinanceDataController::class, 'syncSellers']);
        Route::put('/finance/sellers/{seller}', [FinanceDataController::class, 'updateSeller']);
        Route::delete('/finance/sellers/{seller}', [FinanceDataController::class, 'destroySeller']);
        Route::get('/financing-applications', [FinancingApplicationController::class, 'index']);
        Route::put('/financing-applications/{application}', [FinancingApplicationController::class, 'update']);
        Route::get(
            '/financing-documents/{document}',
            [FinancingApplicationController::class, 'downloadDocument']
        );
    });

    Route::middleware('panel.role:vendedor')->group(function () {
        Route::get('/leads', [LeadController::class, 'index']);
        Route::post('/leads', [LeadController::class, 'store']);
        Route::put('/leads/sync', [LeadController::class, 'sync']);
        Route::put('/leads/{lead}', [LeadController::class, 'update']);
        Route::delete('/leads/{lead}', [LeadController::class, 'destroy']);
        Route::get('/leads/{lead}/communications', [CustomerCommunicationController::class, 'index']);
        Route::post('/leads/{lead}/communications', [CustomerCommunicationController::class, 'store']);
    });

    Route::middleware('panel.role:marketing')->group(function () {
        Route::put('/site/testimonials/sync', [SiteContentController::class, 'syncTestimonials']);
        Route::put('/site/partners/sync', [SiteContentController::class, 'syncPartners']);
        Route::put('/site/settings', [SiteContentController::class, 'syncSettings']);
        Route::get('/analytics', [OperationsController::class, 'analytics']);
        Route::put('/analytics/sync', [OperationsController::class, 'syncAnalytics']);
        Route::delete('/analytics', [OperationsController::class, 'clearAnalytics']);
    });

    Route::middleware('panel.role:gestor')->group(function () {
        Route::get('/admin/users', [AdminUserController::class, 'index']);
        Route::post('/admin/users', [AdminUserController::class, 'store']);
        Route::put('/admin/users/{user}', [AdminUserController::class, 'update']);
        Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy']);
    });
});
