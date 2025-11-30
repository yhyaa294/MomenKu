<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    
    @if($themeConfig['confetti'])
        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    @endif

    <style>
        [x-cloak] { display: none !important; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col {{ $themeConfig['bg_classes'] }} {{ $themeConfig['text_classes'] }} antialiased overflow-x-hidden">

    <!-- Music Control -->
    @if($page->music_url)
        <div x-data="{ playing: true }" x-init="$refs.audio.play().catch(() => playing = false)" class="fixed top-4 right-4 z-50">
            <audio x-ref="audio" loop id="bg-music">
                <source src="{{ asset('storage/' . $page->music_url) }}" type="audio/mpeg">
            </audio>
            <button @click="playing ? $refs.audio.pause() : $refs.audio.play(); playing = !playing" 
                    class="bg-white/20 backdrop-blur-md border border-white/30 p-3 rounded-full shadow-lg hover:bg-white/30 transition-all text-sm font-bold flex items-center gap-2 {{ $themeConfig['dark_mode'] ? 'text-white' : 'text-gray-800' }}">
                <span x-text="playing ? '🔊' : '🔇'"></span>
            </button>
        </div>
    @endif

    <main class="flex-grow flex flex-col items-center justify-center p-6 relative">
        
        <!-- Content Container -->
        <div class="max-w-md w-full text-center space-y-10 animate-fade-in-up z-10">
            
            <!-- Header -->
            <div class="space-y-2">
                <h1 class="text-5xl md:text-6xl font-bold tracking-tight">{{ $page->title }}</h1>
                <p class="text-xl opacity-80 italic">For {{ $page->recipient_name }}</p>
            </div>

            <!-- Media Slider -->
            @if($page->media->count() > 0)
                <div x-data="{ activeSlide: 0, slides: {{ $page->media->count() }} }" 
                     class="relative w-full aspect-[4/5] rounded-2xl overflow-hidden shadow-2xl {{ $themeConfig['dark_mode'] ? 'bg-gray-800' : 'bg-white' }}">
                    
                    @foreach($page->media as $index => $media)
                        <div x-show="activeSlide === {{ $index }}" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute inset-0">
                            <img src="{{ asset('storage/' . $media->file_path) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                    
                    @if($page->media->count() > 1)
                        <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                            @foreach($page->media as $index => $media)
                                <button @click="activeSlide = {{ $index }}" 
                                        class="w-2 h-2 rounded-full transition-all"
                                        :class="activeSlide === {{ $index }} ? 'bg-white w-4' : 'bg-white/50'"></button>
                            @endforeach
                        </div>
                        
                        <button @click="activeSlide = activeSlide === 0 ? slides - 1 : activeSlide - 1" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 text-white p-2 rounded-full backdrop-blur-sm transition-colors">❮</button>
                        <button @click="activeSlide = activeSlide === slides - 1 ? 0 : activeSlide + 1" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/20 hover:bg-black/40 text-white p-2 rounded-full backdrop-blur-sm transition-colors">❯</button>
                    @endif
                </div>
            @endif

            <!-- Message -->
            <div class="p-8 rounded-2xl shadow-xl text-lg leading-relaxed whitespace-pre-wrap {{ $themeConfig['dark_mode'] ? 'bg-gray-800/50 border border-white/10' : 'bg-white/80 border border-white/40' }} backdrop-blur-md">
                {{ $page->message }}
            </div>

        </div>

        <!-- Decorative Elements based on theme could go here -->
    </main>

    <footer class="w-full py-6 text-center text-xs opacity-60">
        <p class="font-medium">Made with MomenKu</p>
        @if(auth()->id() == $page->user_id && !$page->is_premium)
            <form action="{{ route('page.upgrade', $page) }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-4 py-1.5 rounded-full font-bold hover:opacity-90 shadow-sm transform hover:scale-105 transition-all">
                    Remove Branding
                </button>
            </form>
        @endif
    </footer>

    @if($themeConfig['confetti'])
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initial burst
            var duration = 3 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            function randomInRange(min, max) {
              return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function() {
              var timeLeft = animationEnd - Date.now();

              if (timeLeft <= 0) {
                return clearInterval(interval);
              }

              var particleCount = 50 * (timeLeft / duration);
              // since particles fall down, start a bit higher than random
              confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
              confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);

            // Add click handler for fun
            document.addEventListener('click', (e) => {
                confetti({
                    origin: { x: e.clientX / window.innerWidth, y: e.clientY / window.innerHeight }
                });
            });
        });
    </script>
    @endif

</body>
</html>

