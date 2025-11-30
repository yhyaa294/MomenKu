<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        [x-cloak] { display: none !important; }
        
        /* Theme Specific Styles */
        .theme-confetti {
            background: linear-gradient(to bottom right, #fff1eb, #ace0f9);
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }
        .theme-dark-romantic {
            background: linear-gradient(to bottom, #232526, #414345);
            color: #fff;
            font-family: 'Georgia', serif;
        }
        .theme-minimal {
            background-color: #f9fafb;
            font-family: 'Helvetica Neue', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col {{ 'theme-' . $page->theme_style }}">

    @if($page->music_url)
        <audio autoplay loop id="bg-music">
            <source src="{{ asset('storage/' . $page->music_url) }}" type="audio/mpeg">
        </audio>
        <div class="fixed top-4 right-4 z-50">
            <button onclick="document.getElementById('bg-music').paused ? document.getElementById('bg-music').play() : document.getElementById('bg-music').pause()" class="bg-white/50 p-2 rounded-full backdrop-blur-sm">
                🎵 Toggle Music
            </button>
        </div>
    @endif

    <main class="flex-grow flex flex-col items-center justify-center p-4">
        
        <div class="max-w-md w-full text-center space-y-8 animate-fade-in-up">
            
            <!-- Header -->
            <div>
                <h1 class="text-4xl md:text-6xl font-bold mb-2">{{ $page->title }}</h1>
                <p class="text-xl opacity-80">For {{ $page->recipient_name }}</p>
            </div>

            <!-- Media Slider (Simple) -->
            @if($page->media->count() > 0)
                <div x-data="{ activeSlide: 0, slides: {{ $page->media->count() }} }" class="relative w-full aspect-square rounded-xl overflow-hidden shadow-2xl bg-black/10">
                    @foreach($page->media as $index => $media)
                        <div x-show="activeSlide === {{ $index }}" class="absolute inset-0 transition-opacity duration-500 ease-in-out">
                            <img src="{{ asset('storage/' . $media->file_path) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                    
                    @if($page->media->count() > 1)
                        <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/30 p-2 rounded-full">❮</button>
                        <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/30 p-2 rounded-full">❯</button>
                    @endif
                </div>
            @endif

            <!-- Message -->
            <div class="bg-white/80 backdrop-blur-md p-6 rounded-xl shadow-lg text-gray-800 text-lg leading-relaxed whitespace-pre-wrap">
                {{ $page->message }}
            </div>

        </div>
    </main>

    @if(!$page->is_premium)
        <footer class="w-full py-4 bg-gray-900 text-white text-center text-sm opacity-90">
            <p>Created with <a href="{{ route('home') }}" class="font-bold underline">MomenKu</a></p>
            <p class="text-xs text-gray-400 mt-1">Upgrade to remove this watermark</p>
            <form action="{{ route('page.show', $page->slug) }}" method="GET" class="mt-2">
                 <!-- In a real app, this would link to a checkout for this specific page -->
                 <!-- For stub purposes, we can show a buy button if it was the owner viewing, but for public view, maybe just the branding -->
            </form>
            @if(auth()->id() == $page->user_id)
                <form action="{{ route('page.upgrade', $page) }}" method="POST" class="mt-2 inline-block">
                    @csrf
                    <button type="submit" class="bg-yellow-500 text-black px-4 py-1 rounded-full text-xs font-bold hover:bg-yellow-400">
                        Upgrade Now ($9.99)
                    </button>
                </form>
            @endif
        </footer>
    @endif

</body>
</html>
