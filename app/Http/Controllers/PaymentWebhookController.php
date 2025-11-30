<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentWebhookController extends Controller
{
    public function simulate($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        
        // Simulate success
        $transaction->update(['status' => 'PAID']);
        $transaction->page->update(['is_premium' => true]);

        return redirect()->route('page.show', ['slug' => $transaction->page->slug])
            ->with('success', 'Payment successful! Your page is now premium.');
    }

    public function handle(Request $request)
    {
        // Real webhook logic would go here
        return response()->json(['status' => 'ok']);
    }
}
