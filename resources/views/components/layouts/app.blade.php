<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MomenKu - Buat Momen Spesial' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-full.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Caveat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Animations */
        @keyframes popUp {
            0% { transform: translateY(50px) scale(0.8); opacity: 0; }
            60% { transform: translateY(-5px) scale(1.05); }
            100% { transform: translateY(0) scale(1); opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .logo-animate { animation: popUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
        .float-animate { animation: float 3s ease-in-out infinite; }
        
        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        
        /* Hide Scrollbar */
        ::-webkit-scrollbar { display: none; }
        html { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Font Classes */
        .font-hand { font-family: 'Caveat', cursive !important; }
        .font-serif { font-family: 'Playfair Display', serif !important; }
        .font-sans { font-family: 'Outfit', sans-serif !important; }
    </style>
    @livewireStyles
</head>
<body class="bg-brand-cream font-sans text-brand-slate antialiased selection:bg-brand-coral selection:text-white overflow-x-hidden">
    
    <!-- Background Decoration -->
    <div class="fixed inset-0 -z-50 pointer-events-none overflow-hidden">
        <img src="{{ asset('images/bg-blobs.png') }}" class="w-full h-full object-cover opacity-30" alt="">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-coral/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-brand-orange/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col w-full max-w-[1440px] mx-auto px-4 md:px-6 relative">
        
        <!-- Header -->
        <header class="py-5 flex justify-center lg:justify-start sticky top-0 z-50 backdrop-blur-md bg-brand-cream/80">
            <a href="/" class="hover:scale-105 transition-transform">
                <img src="{{ asset('images/logo-full.png') }}" alt="MomenKu" class="h-10 md:h-12 w-auto object-contain logo-animate">
            </a>
        </header>

        <!-- Page Content -->
        <main class="flex-grow z-10 w-full">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="py-6 text-center relative mt-8 z-10 border-t border-brand-slate/5">
            <!-- Mobile Nav -->
            <div class="flex justify-center gap-10 mb-4 lg:hidden">
                <a href="/" class="flex flex-col items-center gap-1 hover:scale-110 transition-transform">
                    <img src="{{ asset('images/icon-home.png') }}" class="w-7 h-7 object-contain" alt="Home">
                    <span class="text-[10px] font-bold text-brand-slate/50">Home</span>
                </a>
                <a href="/" class="flex flex-col items-center gap-1 hover:scale-110 transition-transform">
                    <img src="{{ asset('images/icon-create.png') }}" class="w-7 h-7 object-contain" alt="Create">
                    <span class="text-[10px] font-bold text-brand-slate/50">Create</span>
                </a>
                <a href="#" class="flex flex-col items-center gap-1 hover:scale-110 transition-transform">
                    <img src="{{ asset('images/icon-user.png') }}" class="w-7 h-7 object-contain" alt="Profile">
                    <span class="text-[10px] font-bold text-brand-slate/50">Profile</span>
                </a>
            </div>
            <p class="text-xs font-bold text-brand-slate/40">Made with 💝 by MomenKu</p>
            <p class="text-[10px] text-brand-slate/30 mt-1">© 2025 All rights reserved</p>
        </footer>
    </div>
    
    @livewireScripts
</body>
</html>
