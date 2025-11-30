<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentWebhookController;
use App\Livewire\PageBuilder;

Route::get('/', [LandingController::class, 'index'])->name('home');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/create', PageBuilder::class)->name('page.create');
});

// Payment Stub Routes
Route::get('/payment/simulate/{transaction}', [PaymentWebhookController::class, 'simulate'])->name('payment.simulate');
Route::post('/payment/webhook', [PaymentWebhookController::class, 'handle'])->name('payment.webhook');

// require __DIR__.'/auth.php';

// Public Page Viewer - Must be last
Route::post('/pages/{page}/upgrade', [PageController::class, 'upgrade'])->name('page.upgrade');
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
