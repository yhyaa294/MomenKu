<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MomenKu' }}</title>
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        'brand-coral': '#FF6B6B',
                        'brand-orange': '#FFA502',
                        'brand-cream': '#FFF9F5',
                        'brand-slate': '#2D3436',
                        'brand-teal': '#1DD1A1',
                    }
                }
            }
        }
    </script>
    <style>
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.6;
            z-index: -1;
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
    @livewireStyles
</head>
<body class="bg-brand-cream font-sans text-brand-slate antialiased selection:bg-brand-coral selection:text-white">
    <!-- Unlocked Container Width for Desktop -->
    <div class="min-h-screen flex flex-col w-full max-w-[1440px] mx-auto px-6 relative overflow-hidden">
        
        <!-- Background Blobs (Larger & Softer) -->
        <div class="blob bg-brand-coral w-[500px] h-[500px] top-[-10%] left-[-10%] opacity-20 animate-pulse"></div>
        <div class="blob bg-brand-orange w-[600px] h-[600px] bottom-[-10%] right-[-10%] opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
        <div class="blob bg-purple-300 w-[400px] h-[400px] top-[20%] left-[40%] transform -translate-x-1/2 -translate-y-1/2 opacity-10"></div>

        <!-- Header -->
        <header class="py-6 flex justify-center lg:justify-start sticky top-0 z-50">
            <a href="/" class="glass px-8 py-3 rounded-full text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-brand-coral to-brand-orange hover:scale-105 transition-transform cursor-pointer shadow-sm backdrop-blur-xl border-white/40">
                MomenKu
            </a>
        </header>

        <!-- Page Content -->
        <main class="flex-grow z-10 w-full">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="py-8 text-center relative mt-10 z-10 border-t border-brand-slate/5">
            <p class="text-sm font-bold text-brand-slate/50">Made for Gen-Z ⚡</p>
            <p class="text-xs text-brand-slate/30 mt-1">© 2025 MomenKu</p>
        </footer>
    </div>
    @livewireScripts
</body>
</html>
