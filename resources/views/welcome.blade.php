<x-layouts.app title="MomenKu - Bikin Ucapan Digital Aesthetic">

    <div class="min-h-[80vh] flex flex-col items-center justify-center px-4 py-12">
        
        <!-- HERO SECTION -->
        <div class="text-center space-y-6 max-w-lg mx-auto">
            
            <!-- Floating Gift Box -->
            <div class="relative inline-block">
                <div class="absolute inset-0 bg-brand-coral/20 blur-3xl rounded-full scale-150 animate-pulse"></div>
                <img src="{{ asset('images/empty-box.png') }}" 
                     alt="Gift Box" 
                     class="w-40 h-40 md:w-52 md:h-52 object-contain relative z-10 drop-shadow-2xl animate-bounce-slow mx-auto">
            </div>

            <!-- Title -->
            <div class="space-y-3">
                <h1 class="text-5xl md:text-6xl font-black text-brand-slate tracking-tight">
                    Momen<span class="text-brand-coral">Ku</span>
                </h1>
                <p class="text-xl md:text-2xl text-brand-slate/70 font-medium leading-relaxed">
                    Bikin ucapan digital paling <span class="text-brand-coral font-bold">aesthetic</span> buat doi/bestie ✨
                </p>
            </div>

            <!-- CTA Button -->
            <a href="/create" 
               class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-brand-coral to-brand-orange text-white font-bold text-xl rounded-full shadow-xl shadow-brand-coral/30 hover:shadow-2xl hover:-translate-y-1 transition-all active:scale-95">
                Mulai Bikin Sekarang 🚀
            </a>
        </div>

        <!-- HOW IT WORKS -->
        <div class="mt-20 w-full max-w-2xl mx-auto">
            <h2 class="text-center text-sm font-bold text-brand-slate/40 uppercase tracking-widest mb-8">
                Cara Kerjanya
            </h2>
            
            <div class="grid grid-cols-3 gap-4 md:gap-8">
                <!-- Step 1 -->
                <div class="text-center space-y-3">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-gradient-to-br from-rose-100 to-orange-100 rounded-2xl flex items-center justify-center text-3xl md:text-4xl shadow-lg">
                        ✍️
                    </div>
                    <div>
                        <p class="font-bold text-brand-slate text-sm md:text-base">Isi Pesan</p>
                        <p class="text-xs text-brand-slate/50 hidden md:block">Tulis ucapan & upload foto</p>
                    </div>
                </div>

                <!-- Arrow -->
                <div class="flex items-center justify-center text-brand-slate/20 text-2xl">→</div>

                <!-- Step 2 -->
                <div class="text-center space-y-3">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-gradient-to-br from-cyan-100 to-blue-100 rounded-2xl flex items-center justify-center text-3xl md:text-4xl shadow-lg">
                        🎨
                    </div>
                    <div>
                        <p class="font-bold text-brand-slate text-sm md:text-base">Hias Kartu</p>
                        <p class="text-xs text-brand-slate/50 hidden md:block">Pilih tema & aksesoris</p>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center mt-6">
                <div class="text-center space-y-3">
                    <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl flex items-center justify-center text-3xl md:text-4xl shadow-lg">
                        🔗
                    </div>
                    <div>
                        <p class="font-bold text-brand-slate text-sm md:text-base">Kirim Link</p>
                        <p class="text-xs text-brand-slate/50 hidden md:block">Bagikan ke orang spesial</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TESTIMONIAL / SOCIAL PROOF -->
        <div class="mt-16 text-center">
            <p class="text-sm text-brand-slate/50 font-medium">
                Sudah dipakai <span class="font-bold text-brand-coral">1,000+</span> orang untuk surprise orang tersayang 💝
            </p>
        </div>

    </div>

    <style>
        @keyframes bounce-slow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        .animate-bounce-slow { animation: bounce-slow 2s ease-in-out infinite; }
    </style>

</x-layouts.app>
