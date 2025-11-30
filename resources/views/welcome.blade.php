<x-layouts.app title="MomenKu - Bikin Ucapan Digital Aesthetic">

    <div class="min-h-[80vh] flex flex-col items-center justify-center px-4 py-12 max-w-7xl mx-auto">
        
        <!-- HERO -->
        <div class="text-center space-y-6 max-w-xl mx-auto">
            
            <!-- Gift Box -->
            <div class="relative inline-block">
                <div class="absolute inset-0 bg-brand-coral/20 blur-3xl rounded-full scale-150 animate-pulse"></div>
                <img src="{{ asset('images/empty-box.png') }}" 
                     alt="Gift Box" 
                     class="w-36 h-36 md:w-48 md:h-48 object-contain relative z-10 drop-shadow-2xl animate-bounce-slow mx-auto">
            </div>

            <!-- Title -->
            <div class="space-y-3">
                <h1 class="text-4xl md:text-6xl font-black text-brand-slate tracking-tight">
                    Momen<span class="text-brand-coral">Ku</span>
                </h1>
                <p class="text-lg md:text-xl text-brand-slate/70 font-medium leading-relaxed max-w-md mx-auto">
                    Bikin ucapan digital paling <span class="text-brand-coral font-bold">aesthetic</span> buat doi/bestie ✨
                </p>
            </div>

            <!-- CTA -->
            <a href="/create" 
               class="inline-flex items-center gap-3 px-8 py-4 md:px-10 md:py-5 bg-gradient-to-r from-brand-coral to-brand-orange text-white font-bold text-lg md:text-xl rounded-full shadow-xl shadow-brand-coral/30 hover:shadow-2xl hover:-translate-y-1 transition-all active:scale-95">
                Mulai Bikin 🚀
            </a>
        </div>

        <!-- HOW IT WORKS -->
        <div class="mt-16 md:mt-20 w-full max-w-2xl mx-auto">
            <h2 class="text-center text-xs font-bold text-brand-slate/40 uppercase tracking-widest mb-8">
                Cara Kerjanya
            </h2>
            
            <div class="flex items-center justify-center gap-4 md:gap-8">
                @foreach([
                    ['icon' => '✍️', 'title' => 'Isi', 'bg' => 'from-rose-100 to-orange-100'],
                    ['icon' => '🎨', 'title' => 'Hias', 'bg' => 'from-cyan-100 to-blue-100'],
                    ['icon' => '🔗', 'title' => 'Kirim', 'bg' => 'from-purple-100 to-pink-100'],
                ] as $i => $step)
                    @if($i > 0)
                        <span class="text-brand-slate/20 text-xl">→</span>
                    @endif
                    <div class="text-center">
                        <div class="w-14 h-14 md:w-16 md:h-16 mx-auto bg-gradient-to-br {{ $step['bg'] }} rounded-2xl flex items-center justify-center text-2xl md:text-3xl shadow-lg">
                            {{ $step['icon'] }}
                        </div>
                        <p class="font-bold text-brand-slate text-sm mt-2">{{ $step['title'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Social Proof -->
        <div class="mt-12 text-center">
            <p class="text-sm text-brand-slate/50">
                Sudah dipakai <span class="font-bold text-brand-coral">1,000+</span> orang 💝
            </p>
        </div>
    </div>

    <style>
        @keyframes bounce-slow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
        .animate-bounce-slow { animation: bounce-slow 2s ease-in-out infinite; }
    </style>

</x-layouts.app>
