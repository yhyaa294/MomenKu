<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }} - MomenKu</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-full.png') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Caveat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        hand: ['Caveat', 'cursive'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    
    @php
        $fontClass = match($page->font_style) {
            'caveat' => 'font-hand',
            'playfair' => 'font-serif',
            default => 'font-sans'
        };
        $bgGradient = match($page->color_theme) {
            'ocean' => 'from-cyan-400 via-blue-500 to-indigo-600',
            'midnight' => 'from-slate-900 via-purple-900 to-slate-800',
            'candy' => 'from-pink-400 via-fuchsia-500 to-purple-600',
            default => 'from-rose-400 via-orange-400 to-amber-400'
        };
    @endphp
</head>
<body class="min-h-screen bg-gradient-to-br {{ $bgGradient }} font-sans">

    <div x-data="{ opened: false, playing: false }" class="min-h-screen w-full flex justify-center items-center p-0 lg:p-6">
        
        <!-- THE CARD (Phone Simulator) -->
        <div class="w-full max-w-md bg-gradient-to-br {{ $bgGradient }} min-h-screen lg:min-h-0 lg:h-[800px] lg:rounded-[2.5rem] lg:shadow-2xl lg:border-8 lg:border-gray-900 overflow-hidden relative">
            
            <!-- Desktop Notch -->
            <div class="hidden lg:block absolute top-0 left-1/2 -translate-x-1/2 w-24 h-6 bg-gray-900 rounded-b-2xl z-20"></div>

            <!-- STATE A: GIFT BOX -->
            <div x-show="!opened" 
                 x-transition:leave="transition ease-in duration-500"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-150"
                 class="absolute inset-0 z-10 flex flex-col items-center justify-center p-6 bg-white/10 backdrop-blur-sm">
                
                <div @click="opened = true; confetti({ particleCount: 150, spread: 100, origin: { y: 0.5 } });" 
                     class="relative cursor-pointer group">
                    <div class="absolute inset-0 bg-white/30 blur-3xl rounded-full scale-150 animate-pulse"></div>
                    <img src="{{ asset('images/empty-box.png') }}" 
                         class="w-40 h-40 md:w-52 md:h-52 object-contain relative z-10 drop-shadow-2xl group-hover:scale-110 transition-transform animate-bounce-slow">
                    <div class="absolute -top-2 -right-2 text-2xl animate-ping">✨</div>
                </div>
                
                <div class="text-center mt-6 space-y-2">
                    <h2 class="text-2xl font-black text-white drop-shadow-lg">Ada kado buat kamu! 🎁</h2>
                    <p class="text-white/80 animate-pulse">Ketuk untuk buka</p>
                </div>
            </div>

            <!-- STATE B: CONTENT -->
            <div x-show="opened" 
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-y-10"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="h-full overflow-y-auto">
                
                <div class="p-6 pt-10 lg:pt-12 space-y-6 pb-24">
                    
                    <!-- Header -->
                    <header class="text-center space-y-2">
                        <h1 class="text-3xl md:text-4xl font-black text-white drop-shadow-lg {{ $fontClass }}">
                            {{ $page->title }}
                        </h1>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur rounded-full">
                            <span>💝</span>
                            <span class="font-bold text-white">For {{ $page->recipient_name }}</span>
                        </div>
                    </header>

                    <!-- Photos -->
                    @if($page->media->count() > 0)
                        <section>
                            @if($page->layout_mode == 'carousel')
                                <div class="relative w-full aspect-[4/5] rounded-2xl overflow-hidden shadow-xl bg-white/10">
                                    <div class="flex snap-x snap-mandatory overflow-x-auto h-full" style="scrollbar-width: none;">
                                        @foreach($page->media as $media)
                                            <div class="snap-center min-w-full h-full flex-shrink-0 p-1">
                                                <img src="{{ asset('storage/' . $media->file_path) }}" class="w-full h-full object-cover rounded-xl">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 px-3 py-1 bg-black/30 backdrop-blur rounded-full text-white/90 text-xs">
                                        Swipe →
                                    </div>
                                </div>
                            @elseif($page->layout_mode == 'grid')
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach($page->media as $i => $media)
                                        <div class="rounded-xl overflow-hidden shadow-lg {{ $i == 0 ? 'col-span-2' : '' }}">
                                            <img src="{{ asset('storage/' . $media->file_path) }}" class="w-full {{ $i == 0 ? 'aspect-video' : 'aspect-square' }} object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @elseif($page->layout_mode == 'polaroid')
                                <div class="relative min-h-[300px] flex items-center justify-center py-4">
                                    @foreach($page->media as $i => $media)
                                        @php $rot = [-8, 5, -3][$i % 3]; @endphp
                                        <div class="absolute bg-white p-2 pb-8 shadow-xl hover:z-50 hover:scale-110 transition-all" style="transform: rotate({{ $rot }}deg); z-index: {{ $i }};">
                                            <img src="{{ asset('storage/' . $media->file_path) }}" class="w-36 h-36 object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="w-full aspect-[4/5] rounded-2xl overflow-hidden shadow-xl">
                                    <img src="{{ asset('storage/' . $page->media->first()->file_path) }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                        </section>
                    @endif

                    <!-- Message -->
                    <section>
                        <div class="bg-white/20 backdrop-blur-xl rounded-2xl p-5 border border-white/30 shadow-xl">
                            <p class="text-white leading-relaxed whitespace-pre-wrap {{ $fontClass }}">{{ $page->message }}</p>
                            <div class="mt-4 pt-3 border-t border-white/20 flex justify-between text-xs text-white/60">
                                <span>Made with 💝</span>
                                <span>{{ $page->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </section>

                    <!-- Share -->
                    <button onclick="navigator.share ? navigator.share({title: '{{ $page->title }}', url: location.href}) : (navigator.clipboard.writeText(location.href), alert('Link disalin!'))"
                            class="w-full py-3 bg-white/20 backdrop-blur rounded-xl text-white font-bold flex items-center justify-center gap-2 hover:bg-white/30 transition-all">
                        📤 Bagikan
                    </button>

                    <!-- CTA -->
                    <div class="text-center pt-4">
                        <p class="text-white/60 text-sm mb-3">Mau bikin juga?</p>
                        <a href="/" class="inline-block px-6 py-3 bg-white text-gray-900 font-bold rounded-full shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                            Bikin Momen Kamu ✨
                        </a>
                    </div>

                    <footer class="text-center pt-6">
                        <p class="text-white/40 text-xs uppercase tracking-widest">Made with MomenKu</p>
                    </footer>
                </div>
            </div>

            <!-- Music Player -->
            @if($page->music_url)
                <div x-show="opened" class="absolute bottom-4 right-4 z-30">
                    <audio x-ref="audio" loop src="{{ asset('storage/' . $page->music_url) }}"></audio>
                    <button @click="playing = !playing; playing ? $refs.audio.play() : $refs.audio.pause()" 
                            class="w-12 h-12 rounded-full bg-white shadow-xl flex items-center justify-center text-xl hover:scale-110 transition-all"
                            :class="playing && 'animate-spin-slow'">
                        <span x-text="playing ? '🎵' : '🔇'"></span>
                    </button>
                </div>
            @endif

        </div>
    </div>

    @if($themeConfig['confetti'] ?? false)
    <script>
        document.addEventListener('alpine:init', () => {
            setTimeout(() => {
                const end = Date.now() + 3000;
                (function frame() {
                    confetti({ particleCount: 3, angle: 60, spread: 55, origin: { x: 0 } });
                    confetti({ particleCount: 3, angle: 120, spread: 55, origin: { x: 1 } });
                    if (Date.now() < end) requestAnimationFrame(frame);
                }());
            }, 500);
        });
    </script>
    @endif

    <style>
        @keyframes bounce-slow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
        .animate-bounce-slow { animation: bounce-slow 2s ease-in-out infinite; }
        @keyframes spin-slow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .animate-spin-slow { animation: spin-slow 3s linear infinite; }
        ::-webkit-scrollbar { display: none; }
        html { scrollbar-width: none; }
    </style>
</body>
</html>
