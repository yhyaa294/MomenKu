<div class="min-h-screen bg-brand-cream flex flex-col lg:flex-row">
    
    <!-- LEFT COLUMN: Form Controls -->
    <div class="w-full lg:w-1/2 lg:h-screen lg:overflow-y-auto p-6 lg:p-12">
        
        <!-- Logo (Mobile Only) -->
        <div class="text-center mb-6 lg:hidden">
            <a href="/">
                <img src="{{ asset('images/logo-full.png') }}" alt="MomenKu" class="h-10 mx-auto">
            </a>
        </div>

        <!-- Header -->
        <div class="text-center lg:text-left mb-8">
            <h1 class="text-3xl lg:text-4xl font-black text-brand-slate">Bikin Momen Spesial ✨</h1>
            <p class="text-brand-slate/60 mt-2">Isi, hias, lalu kirim!</p>
        </div>

        <!-- Tab Navigation -->
        <div class="flex justify-center lg:justify-start mb-8">
            <div class="inline-flex bg-white/70 backdrop-blur rounded-full p-1.5 shadow-lg border border-white/50">
                @foreach([1 => '📝 Konten', 2 => '🎨 Hias', 3 => '🚀 Finish'] as $step => $label)
                    <button wire:click="goToStep({{ $step }})" type="button"
                            class="px-4 lg:px-5 py-2.5 rounded-full text-sm font-bold transition-all
                            {{ $currentStep === $step ? 'bg-gradient-to-r from-brand-coral to-brand-orange text-white shadow-md' : 'text-brand-slate/60 hover:text-brand-slate' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        <form wire:submit.prevent="submit" class="space-y-6 pb-32 lg:pb-12">

            <!-- TAB 1: KONTEN -->
            @if($currentStep === 1)
                <div class="space-y-5 animate-fade-in">
                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-2">Buat Siapa?</label>
                        <input wire:model="recipient_name" type="text" 
                               class="w-full text-xl font-bold text-brand-slate bg-transparent border-none focus:ring-0 placeholder-brand-slate/30 p-0"
                               placeholder="Nama doi/bestie...">
                        @error('recipient_name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-2">Judul Kartu</label>
                        <input wire:model.live="title" type="text" 
                               class="w-full text-2xl font-black text-brand-slate bg-transparent border-none focus:ring-0 placeholder-brand-slate/30 p-0"
                               placeholder="Happy Birthday!">
                        @error('title') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-2">Pesan Manis</label>
                        <textarea wire:model="message" rows="4"
                                  class="w-full text-base text-brand-slate bg-transparent border-none focus:ring-0 placeholder-brand-slate/30 p-0 resize-none"
                                  placeholder="Tulis ucapan spesial..."></textarea>
                        @error('message') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Foto Kenangan</label>
                        <label class="block w-full aspect-[3/1] rounded-xl border-2 border-dashed border-brand-slate/20 bg-brand-slate/5 hover:bg-white hover:border-brand-coral transition-all cursor-pointer flex flex-col items-center justify-center">
                            <input wire:model="photos" type="file" multiple accept="image/*" class="hidden">
                            <div wire:loading.remove wire:target="photos" class="text-center">
                                <span class="text-3xl">📷</span>
                                <p class="text-sm font-bold text-brand-slate/60 mt-2">Upload foto</p>
                            </div>
                            <div wire:loading wire:target="photos" class="text-center">
                                <div class="w-8 h-8 border-4 border-brand-coral border-t-transparent rounded-full animate-spin mx-auto"></div>
                                <p class="text-sm text-brand-coral font-bold mt-2">Uploading...</p>
                            </div>
                        </label>
                        @error('photos.*') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror

                        @if($photos)
                            <div class="grid grid-cols-3 gap-2 mt-4">
                                @foreach($photos as $photo)
                                    <img src="{{ $photo->temporaryUrl() }}" class="w-full aspect-square object-cover rounded-lg shadow">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- TAB 2: HIAS -->
            @if($currentStep === 2)
                <div class="space-y-5 animate-fade-in">
                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Warna Background</label>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach([
                                ['id' => 'sunset', 'colors' => 'from-rose-400 to-orange-400'],
                                ['id' => 'ocean', 'colors' => 'from-cyan-400 to-blue-500'],
                                ['id' => 'midnight', 'colors' => 'from-slate-800 to-purple-900'],
                                ['id' => 'candy', 'colors' => 'from-pink-400 to-purple-500']
                            ] as $theme)
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="color_theme" value="{{ $theme['id'] }}" class="sr-only peer">
                                    <div class="aspect-square rounded-xl bg-gradient-to-br {{ $theme['colors'] }} shadow peer-checked:ring-4 peer-checked:ring-brand-coral peer-checked:ring-offset-2 transition-all hover:scale-105"></div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Gaya Tulisan</label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach([
                                ['id' => 'outfit', 'name' => 'Modern', 'class' => 'font-sans'],
                                ['id' => 'caveat', 'name' => 'Handwritten', 'class' => 'font-hand'],
                                ['id' => 'playfair', 'name' => 'Elegant', 'class' => 'font-serif']
                            ] as $font)
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="font_style" value="{{ $font['id'] }}" class="sr-only peer">
                                    <div class="p-3 rounded-xl border-2 text-center transition-all peer-checked:border-brand-coral peer-checked:bg-white peer-checked:shadow-lg border-transparent bg-brand-slate/5">
                                        <span class="text-2xl font-bold text-brand-slate {{ $font['class'] }}">Aa</span>
                                        <p class="text-[10px] font-bold text-brand-slate/50 mt-1">{{ $font['name'] }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Layout Foto</label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach([
                                ['id' => 'carousel', 'icon' => '📱', 'name' => 'Swipe'],
                                ['id' => 'grid', 'icon' => '🖼️', 'name' => 'Grid'],
                                ['id' => 'polaroid', 'icon' => '📷', 'name' => 'Polaroid']
                            ] as $layout)
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="layout_mode" value="{{ $layout['id'] }}" class="sr-only peer">
                                    <div class="p-3 rounded-xl border-2 text-center transition-all peer-checked:border-brand-coral peer-checked:bg-white peer-checked:shadow-lg border-transparent bg-brand-slate/5">
                                        <span class="text-xl">{{ $layout['icon'] }}</span>
                                        <p class="text-[10px] font-bold text-brand-slate/50 mt-1">{{ $layout['name'] }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Efek Spesial</label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach([
                                ['id' => 'confetti', 'icon' => '🎉'],
                                ['id' => 'dark-romantic', 'icon' => '💝'],
                                ['id' => 'minimal', 'icon' => '✨']
                            ] as $effect)
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model.live="theme_style" value="{{ $effect['id'] }}" class="sr-only peer">
                                    <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-brand-coral peer-checked:bg-white peer-checked:shadow-lg border-transparent bg-brand-slate/5">
                                        <span class="text-2xl">{{ $effect['icon'] }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">
                            Music <span class="text-amber-500">(Premium)</span>
                        </label>
                        <label class="flex items-center gap-3 p-3 rounded-xl border-2 border-dashed border-brand-slate/20 hover:border-brand-coral cursor-pointer transition-all">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-coral to-brand-orange flex items-center justify-center text-white shadow">🎵</div>
                            <div class="flex-1 min-w-0">
                                @if($music_file)
                                    <p class="font-bold text-brand-slate text-sm truncate">{{ $music_file->getClientOriginalName() }}</p>
                                @else
                                    <p class="font-bold text-brand-slate text-sm">Upload Lagu</p>
                                @endif
                            </div>
                            <input wire:model="music_file" type="file" accept="audio/*" class="hidden">
                        </label>
                    </div>
                </div>
            @endif

            <!-- TAB 3: FINISH -->
            @if($currentStep === 3)
                <div class="space-y-5 animate-fade-in">
                    <div class="bg-white/70 backdrop-blur rounded-2xl p-5 shadow-lg border border-white/50">
                        <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-2">Custom Link</label>
                        <div class="flex items-center bg-brand-slate/5 rounded-xl px-4">
                            <span class="text-brand-slate/40 text-sm">momenku.com/</span>
                            <input wire:model="slug" type="text" 
                                   class="flex-1 bg-transparent border-none focus:ring-0 py-3 text-brand-coral font-bold placeholder-brand-coral/30"
                                   placeholder="link-kamu">
                        </div>
                        @error('slug') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" wire:loading.attr="disabled"
                            class="w-full py-4 bg-gradient-to-r from-brand-coral to-brand-orange text-white font-bold text-lg rounded-2xl shadow-xl shadow-brand-coral/30 hover:shadow-2xl hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="submit">Generate Link 🚀</span>
                        <span wire:loading wire:target="submit">Generating...</span>
                    </button>
                </div>
            @endif

            <!-- Navigation (Mobile Fixed) -->
            <div class="fixed bottom-0 left-0 w-full p-4 bg-gradient-to-t from-brand-cream via-brand-cream to-transparent lg:static lg:p-0 lg:bg-transparent z-40">
                <div class="flex gap-3 max-w-lg mx-auto lg:max-w-none">
                    @if($currentStep > 1)
                        <button wire:click="previousStep" type="button"
                                class="px-6 py-3 bg-white rounded-xl font-bold text-brand-slate shadow-lg">
                            ←
                        </button>
                    @endif
                    @if($currentStep < 3)
                        <button wire:click="nextStep" type="button"
                                class="flex-1 py-3 bg-brand-slate text-white rounded-xl font-bold shadow-lg flex items-center justify-center gap-2">
                            Lanjut →
                        </button>
                    @endif
                </div>
            </div>

        </form>
    </div>

    <!-- RIGHT COLUMN: Live Preview (Desktop Only) -->
    <div class="hidden lg:flex w-1/2 h-screen sticky top-0 bg-gradient-to-br from-gray-100 to-gray-200 items-center justify-center p-8">
        <!-- Phone Frame -->
        <div class="w-[320px] h-[680px] bg-white rounded-[3rem] shadow-2xl border-[10px] border-gray-900 overflow-hidden relative">
            <!-- Notch -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-6 bg-gray-900 rounded-b-2xl z-10"></div>
            
            <!-- Screen Content -->
            <div class="w-full h-full overflow-y-auto bg-gradient-to-br
                {{ $color_theme == 'sunset' ? 'from-rose-400 to-orange-400' : '' }}
                {{ $color_theme == 'ocean' ? 'from-cyan-400 to-blue-500' : '' }}
                {{ $color_theme == 'midnight' ? 'from-slate-800 to-purple-900' : '' }}
                {{ $color_theme == 'candy' ? 'from-pink-400 to-purple-500' : '' }}">
                
                <div class="p-5 pt-10 text-center space-y-4">
                    <h2 class="text-xl font-bold text-white drop-shadow {{ $font_style == 'caveat' ? 'font-hand' : ($font_style == 'playfair' ? 'font-serif' : '') }}"
                        style="{{ !$title ? 'opacity: 0.5' : '' }}">
                        {{ $title ?: 'Judul Kamu' }}
                    </h2>
                    <p class="text-white/80 text-sm">For {{ $recipient_name ?: 'Nama' }}</p>

                    @if(count($photos) > 0)
                        <div class="space-y-2">
                            @foreach($photos as $photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="w-full aspect-square object-cover rounded-xl shadow">
                            @endforeach
                        </div>
                    @else
                        <div class="w-full aspect-square bg-white/20 rounded-xl flex items-center justify-center">
                            <span class="text-white/50 text-4xl">📷</span>
                        </div>
                    @endif

                    <div class="bg-white/20 backdrop-blur rounded-xl p-4">
                        <p class="text-white/90 text-sm {{ $font_style == 'caveat' ? 'font-hand' : ($font_style == 'playfair' ? 'font-serif' : '') }}"
                           style="{{ !$message ? 'opacity: 0.5' : '' }}">
                            {{ $message ?: 'Pesan kamu...' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Modal -->
    @if($showPremiumModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-3xl p-6 max-w-sm w-full shadow-2xl text-center space-y-4">
                <span class="text-5xl">👑</span>
                <h3 class="text-xl font-black text-brand-slate">Upgrade Premium?</h3>
                <p class="text-brand-slate/60 text-sm">Unlimited photos & custom music!</p>
                <button wire:click="goPremium" class="w-full py-3 bg-brand-slate text-white rounded-xl font-bold">
                    Upgrade Rp 10.000
                </button>
                <button wire:click="stayFree" class="w-full py-2 text-brand-slate/50 font-bold text-sm">
                    Pakai Gratis
                </button>
            </div>
        </div>
    @endif

    <style>
        .animate-fade-in { animation: fadeIn 0.3s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</div>
