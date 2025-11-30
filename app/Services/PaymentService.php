<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Transaction;
use Illuminate\Support\Facades\URL;

class PaymentService
{
    public function createTransaction(Page $page, $amount)
    {
        // Create a pending transaction
        $transaction = Transaction::create([
            'user_id' => $page->user_id,
            'page_id' => $page->id,
            'external_ref' => 'PAY-' . uniqid(),
            'payment_method' => 'MOCK_GATEWAY',
            'amount' => $amount,
            'status' => 'PENDING',
        ]);

        // Return a dummy URL that simulates payment completion
        // In a real app, this would be the gateway's checkout URL
        return route('payment.simulate', ['transaction' => $transaction->id]);
    }
}
