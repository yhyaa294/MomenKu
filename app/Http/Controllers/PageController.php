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

        // Theme Logic
        $themeConfig = [
            'confetti' => false,
            'dark_mode' => false,
            'bg_classes' => 'bg-gray-50',
            'text_classes' => 'text-gray-900',
        ];

        switch ($page->theme_style) {
            case 'confetti':
                $themeConfig['confetti'] = true;
                $themeConfig['bg_classes'] = 'bg-gradient-to-br from-yellow-50 via-pink-50 to-indigo-50';
                $themeConfig['text_classes'] = 'font-sans text-gray-800';
                break;
            case 'dark-romantic':
                $themeConfig['dark_mode'] = true;
                $themeConfig['bg_classes'] = 'bg-gray-900 text-white';
                $themeConfig['text_classes'] = 'font-serif text-white';
                break;
            case 'minimal':
                $themeConfig['bg_classes'] = 'bg-white';
                $themeConfig['text_classes'] = 'font-mono text-gray-600';
                break;
        }

        return view('pages.show', compact('page', 'themeConfig'));
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
