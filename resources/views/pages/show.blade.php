<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }} - MomenKu</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-full.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Caveat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <!-- Alpine.js -->
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
                    },
                    colors: {
                        'brand-coral': '#FF6B6B',
                        'brand-orange': '#FFA502',
                        'brand-slate': '#1E293B',
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
<body class="min-h-screen font-sans">

    <div x-data="{ 
            opened: false,
            playing: false,
            openGift() {
                // Play sound effect (optional)
                // Trigger confetti
                confetti({
                    particleCount: 150,
                    spread: 100,
                    origin: { y: 0.5 }
                });
                
                // Reveal content
                setTimeout(() => {
                    this.opened = true;
                    
                    // Continuous confetti for confetti theme
                    @if($themeConfig['confetti'] ?? false)
                    const duration = 3000;
                    const end = Date.now() + duration;
                    (function frame() {
                        confetti({ particleCount: 3, angle: 60, spread: 55, origin: { x: 0 } });
                        confetti({ particleCount: 3, angle: 120, spread: 55, origin: { x: 1 } });
                        if (Date.now() < end) requestAnimationFrame(frame);
                    }());
                    @endif
                }, 300);
            },
            toggleMusic() {
                if(this.$refs.audio) {
                    if(this.$refs.audio.paused) {
                        this.$refs.audio.play();
                        this.playing = true;
                    } else {
                        this.$refs.audio.pause();
                        this.playing = false;
                    }
                }
            }
        }" 
        class="min-h-screen relative">

        <!-- ==================== STATE A: GIFT BOX (Locked) ==================== -->
        <div x-show="!opened" 
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-150"
             class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-gradient-to-br {{ $bgGradient }} p-6">
            
            <!-- Blur Background Effect -->
            <div class="absolute inset-0 backdrop-blur-sm bg-white/10"></div>
            
            <!-- Gift Box -->
            <div @click="openGift()" class="relative cursor-pointer group">
                <!-- Glow Effect -->
                <div class="absolute inset-0 bg-white/30 blur-3xl rounded-full scale-150 animate-pulse"></div>
                
                <!-- Gift Image -->
                <img src="{{ asset('images/empty-box.png') }}" 
                     alt="Gift Box" 
                     class="w-48 h-48 md:w-64 md:h-64 object-contain relative z-10 drop-shadow-2xl group-hover:scale-110 transition-transform duration-500 animate-bounce-slow">
                
                <!-- Sparkles -->
                <div class="absolute -top-2 -right-2 text-3xl animate-ping">✨</div>
                <div class="absolute -bottom-2 -left-2 text-2xl animate-ping" style="animation-delay: 0.5s">💫</div>
            </div>
            
            <!-- Text -->
            <div class="relative z-10 text-center mt-8 space-y-3">
                <h2 class="text-2xl md:text-3xl font-black text-white drop-shadow-lg">
                    Ada kado buat kamu! 🎁
                </h2>
                <p class="text-lg text-white/80 font-medium animate-pulse">
                    Ketuk kotaknya untuk buka
                </p>
            </div>
        </div>

        <!-- ==================== STATE B: REVEALED CONTENT ==================== -->
        <div x-show="opened" 
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 translate-y-10"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="min-h-screen bg-gradient-to-br {{ $bgGradient }} py-10 px-4">
            
            <div class="max-w-lg mx-auto space-y-8">
                
                <!-- HEADER -->
                <header class="text-center space-y-3 animate-fade-in">
                    <h1 class="text-4xl md:text-5xl font-black text-white drop-shadow-lg {{ $fontClass }}">
                        {{ $page->title }}
                    </h1>
                    <div class="inline-flex items-center gap-2 px-5 py-2 bg-white/20 backdrop-blur-md rounded-full border border-white/30">
                        <span class="text-xl">💝</span>
                        <span class="text-lg font-bold text-white">For {{ $page->recipient_name }}</span>
                    </div>
                </header>

                <!-- PHOTO GALLERY -->
                @if($page->media->count() > 0)
                    <section class="animate-fade-in" style="animation-delay: 0.2s">
                        @if($page->layout_mode == 'carousel')
                            <!-- Carousel -->
                            <div class="relative w-full aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl bg-white/10 backdrop-blur border border-white/20">
                                <div class="flex snap-x snap-mandatory overflow-x-auto h-full" style="scrollbar-width: none;">
                                    @foreach($page->media as $media)
                                        <div class="snap-center min-w-full h-full flex-shrink-0 p-2">
                                            <img src="{{ asset('storage/' . $media->file_path) }}" 
                                                 class="w-full h-full object-cover rounded-2xl">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 px-4 py-2 bg-black/30 backdrop-blur rounded-full">
                                    <span class="text-white/90 text-sm font-medium">Swipe →</span>
                                </div>
                            </div>
                        @elseif($page->layout_mode == 'grid')
                            <!-- Grid -->
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($page->media as $index => $media)
                                    <div class="rounded-2xl overflow-hidden shadow-xl {{ $index == 0 ? 'col-span-2' : '' }}">
                                        <img src="{{ asset('storage/' . $media->file_path) }}" 
                                             class="w-full {{ $index == 0 ? 'aspect-video' : 'aspect-square' }} object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @elseif($page->layout_mode == 'polaroid')
                            <!-- Polaroid -->
                            <div class="relative min-h-[350px] flex items-center justify-center">
                                @foreach($page->media as $index => $media)
                                    @php
                                        $rotations = [-8, 5, -3, 7];
                                        $rotation = $rotations[$index % count($rotations)];
                                    @endphp
                                    <div class="absolute bg-white p-2 pb-10 shadow-2xl hover:z-50 hover:scale-110 transition-all cursor-pointer"
                                         style="transform: rotate({{ $rotation }}deg); z-index: {{ $index }};">
                                        <img src="{{ asset('storage/' . $media->file_path) }}" 
                                             class="w-44 h-44 object-cover">
                                        <p class="absolute bottom-2 left-0 right-0 text-center text-gray-400 text-xs font-hand">
                                            moment #{{ $index + 1 }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- Default: Single Image -->
                            <div class="w-full aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl">
                                @if($page->media->first())
                                    <img src="{{ asset('storage/' . $page->media->first()->file_path) }}" 
                                         class="w-full h-full object-cover">
                                @endif
                            </div>
                        @endif
                    </section>
                @endif

                <!-- MESSAGE CARD -->
                <section class="animate-fade-in" style="animation-delay: 0.4s">
                    <div class="bg-white/20 backdrop-blur-xl rounded-3xl p-6 md:p-8 border border-white/30 shadow-2xl">
                        <div class="text-lg md:text-xl text-white leading-relaxed whitespace-pre-wrap {{ $fontClass }}">
                            {{ $page->message }}
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-white/20 flex items-center justify-between text-sm text-white/60">
                            <span>Made with 💝</span>
                            <span>{{ $page->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </section>

                <!-- SHARE BUTTON -->
                <section class="animate-fade-in" style="animation-delay: 0.5s">
                    <button onclick="shareLink()" 
                            class="w-full py-4 bg-white/20 backdrop-blur-md rounded-2xl border border-white/30 text-white font-bold flex items-center justify-center gap-3 hover:bg-white/30 transition-all active:scale-95">
                        <img src="{{ asset('images/share.png') }}" class="w-6 h-6 object-contain" onerror="this.style.display='none'">
                        <span>Bagikan Momen Ini</span>
                    </button>
                </section>

                <!-- CTA: CREATE YOUR OWN -->
                <section class="animate-fade-in text-center pt-8" style="animation-delay: 0.6s">
                    <p class="text-white/60 text-sm mb-4">Mau bikin kayak gini juga?</p>
                    <a href="/" 
                       class="inline-flex items-center gap-2 px-8 py-4 bg-white text-brand-slate font-bold text-lg rounded-full shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                        Bikin Momen Kamu ✨
                    </a>
                </section>

                <!-- FOOTER -->
                <footer class="text-center pt-8 pb-24">
                    <p class="text-white/40 text-xs font-bold uppercase tracking-widest">Made with MomenKu</p>
                </footer>

            </div>
        </div>

        <!-- MUSIC PLAYER (Floating) -->
        @if($page->music_url)
            <div x-show="opened" class="fixed bottom-6 right-6 z-40">
                <audio x-ref="audio" loop>
                    <source src="{{ asset('storage/' . $page->music_url) }}" type="audio/mpeg">
                </audio>
                <button @click="toggleMusic()" 
                        class="w-14 h-14 rounded-full bg-white shadow-2xl flex items-center justify-center text-2xl hover:scale-110 active:scale-95 transition-all"
                        :class="playing ? 'animate-spin-slow' : ''">
                    <span x-text="playing ? '🎵' : '🔇'"></span>
                </button>
            </div>
        @endif

    </div>

    <script>
        function shareLink() {
            const url = window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: '{{ $page->title }}',
                    text: 'Lihat momen spesial ini! 🎁',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url);
                alert('Link berhasil disalin! 📋');
            }
        }
    </script>

    <style>
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        .animate-bounce-slow { animation: bounce-slow 2s ease-in-out infinite; }
        
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: spin-slow 3s linear infinite; }
        
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
            opacity: 0;
        }
        
        /* Hide scrollbar */
        ::-webkit-scrollbar { display: none; }
        html { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

</body>
</html>
