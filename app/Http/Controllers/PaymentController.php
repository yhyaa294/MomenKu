<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function checkout($page_id)
    {
        $page = Page::findOrFail($page_id);
        
        // Create a pending transaction
        $transaction = Transaction::create([
            'user_id' => Auth::id() ?? 1, // Fallback for dev
            'page_id' => $page->id,
            'amount' => 10000, // Rp 10.000
            'status' => 'PENDING',
            'payment_method' => 'QRIS',
            'external_ref' => 'SIM-' . Str::random(10),
        ]);

        return view('payment.simulate', compact('transaction', 'page'));
    }

    public function callback(Request $request)
    {
        $transaction = Transaction::where('external_ref', $request->external_ref)->firstOrFail();
        
        // Simulate Success
        $transaction->update(['status' => 'PAID']);
        
        // Unlock Premium on Page
        $transaction->page->update(['is_premium' => true]);

        return redirect()->route('page.show', ['slug' => $transaction->page->slug])
                         ->with('success', 'Payment Successful! Premium features unlocked.');
    }
}
