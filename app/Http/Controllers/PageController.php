<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::with('media')->where('slug', $slug)->firstOrFail();

        if ($page->expires_at && Carbon::now()->greaterThan($page->expires_at)) {
            abort(404, 'This page has expired.');
        }

        return view('pages.show', compact('page'));
    }

    public function upgrade(Page $page, \App\Services\PaymentService $paymentService)
    {
        if ($page->is_premium) {
            return back()->with('info', 'Page is already premium');
        }
        
        $url = $paymentService->createTransaction($page, 9.99);
        return redirect($url);
    }
}
