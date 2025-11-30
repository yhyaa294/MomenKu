<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Livewire\PageBuilder;

// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 2. Create Page (PageBuilder)
Route::get('/create', PageBuilder::class)->name('page.create');

// Payment Routes
Route::get('/checkout/{page_id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

// 3. Show Page (MUST BE LAST - catches all slugs)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
