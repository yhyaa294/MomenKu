<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Livewire\PageBuilder;

// Root points to PageBuilder for immediate action
Route::get('/', PageBuilder::class)->name('home');

// Authenticated routes (Optional for now)
Route::middleware(['auth'])->group(function () {
    // Route::get('/create', PageBuilder::class)->name('page.create'); 
});

// Payment Simulation Routes
Route::get('/checkout/{page_id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

// Public Page Viewer - Must be last
Route::post('/pages/{page}/upgrade', [PageController::class, 'upgrade'])->name('page.upgrade');
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
