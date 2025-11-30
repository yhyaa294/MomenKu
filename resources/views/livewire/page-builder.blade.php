<div class="max-w-2xl mx-auto py-8 px-4">

    <!-- HEADER -->
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-black text-brand-slate">Bikin Momen Spesial ✨</h1>
        <p class="text-brand-slate/60 mt-2">Isi, hias, lalu kirim!</p>
    </div>

    <!-- TAB NAVIGATION -->
    <div class="flex justify-center mb-8">
        <div class="inline-flex bg-white/70 backdrop-blur rounded-full p-1.5 shadow-lg border border-white/50">
            @foreach([1 => '📝 Konten', 2 => '🎨 Hias', 3 => '🚀 Finish'] as $step => $label)
                <button wire:click="goToStep({{ $step }})" type="button"
                        class="px-5 py-2.5 rounded-full text-sm font-bold transition-all
                        {{ $currentStep === $step ? 'bg-gradient-to-r from-brand-coral to-brand-orange text-white shadow-md' : 'text-brand-slate/60 hover:text-brand-slate' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <form wire:submit.prevent="submit">

        <!-- TAB 1: KONTEN -->
        @if($currentStep === 1)
            <div class="space-y-6 animate-fade-in">
                
                <!-- Recipient Name -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Buat Siapa?</label>
                    <input wire:model="recipient_name" type="text" 
                           class="w-full text-2xl font-bold text-brand-slate bg-transparent border-none focus:ring-0 placeholder-brand-slate/30 p-0"
                           placeholder="Nama doi/bestie...">
                    @error('recipient_name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Title -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Judul Kartu</label>
                    <input wire:model.live="title" type="text" 
                           class="w-full text-3xl font-black text-brand-slate bg-transparent border-none focus:ring-0 placeholder-brand-slate/30 p-0"
                           placeholder="Happy Birthday!">
                    @error('title') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Message -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Pesan Manis</label>
                    <textarea wire:model="message" rows="4"
                              class="w-full text-lg text-brand-slate bg-transparent border-none focus:ring-0 placeholder-brand-slate/30 p-0 resize-none"
                              placeholder="Tulis ucapan spesial di sini..."></textarea>
                    @error('message') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Photo Upload -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Foto Kenangan</label>
                    
                    <label class="block w-full aspect-[3/1] rounded-xl border-2 border-dashed border-brand-slate/20 bg-brand-slate/5 hover:bg-white hover:border-brand-coral transition-all cursor-pointer flex flex-col items-center justify-center">
                        <input wire:model="photos" type="file" multiple accept="image/*" class="hidden">
                        <div wire:loading.remove wire:target="photos" class="text-center">
                            <span class="text-3xl">📷</span>
                            <p class="text-sm font-bold text-brand-slate/60 mt-2">Klik untuk upload foto</p>
                            <p class="text-xs text-brand-slate/40">Max 3 foto, 10MB each</p>
                        </div>
                        <div wire:loading wire:target="photos" class="text-center">
                            <img src="{{ asset('images/loader.png') }}" class="w-10 h-10 animate-spin mx-auto">
                            <p class="text-sm text-brand-coral font-bold mt-2">Uploading...</p>
                        </div>
                    </label>
                    @error('photos.*') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror

                    @if($photos)
                        <div class="grid grid-cols-3 gap-3 mt-4">
                            @foreach($photos as $photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="w-full aspect-square object-cover rounded-xl shadow-md">
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        @endif

        <!-- TAB 2: HIAS & AKSESORIS -->
        @if($currentStep === 2)
            <div class="space-y-6 animate-fade-in">
                
                <!-- Background Color Theme -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-4">Warna Background</label>
                    <div class="grid grid-cols-4 gap-3">
                        @foreach([
                            ['id' => 'sunset', 'name' => 'Sunset', 'colors' => 'from-rose-400 to-orange-400'],
                            ['id' => 'ocean', 'name' => 'Ocean', 'colors' => 'from-cyan-400 to-blue-500'],
                            ['id' => 'midnight', 'name' => 'Midnight', 'colors' => 'from-slate-800 to-purple-900'],
                            ['id' => 'candy', 'name' => 'Candy', 'colors' => 'from-pink-400 to-purple-500']
                        ] as $theme)
                            <label class="cursor-pointer group">
                                <input type="radio" wire:model.live="color_theme" value="{{ $theme['id'] }}" class="sr-only peer">
                                <div class="flex flex-col items-center p-3 rounded-xl border-2 transition-all peer-checked:border-brand-coral peer-checked:shadow-lg border-transparent hover:border-brand-slate/20">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $theme['colors'] }} shadow-md group-hover:scale-110 transition-transform"></div>
                                    <span class="text-xs font-bold text-brand-slate/60 mt-2">{{ $theme['name'] }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Font Style -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-4">Gaya Tulisan</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([
                            ['id' => 'outfit', 'name' => 'Modern', 'preview' => 'Aa'],
                            ['id' => 'caveat', 'name' => 'Handwritten', 'preview' => 'Aa'],
                            ['id' => 'playfair', 'name' => 'Elegant', 'preview' => 'Aa']
                        ] as $font)
                            <label class="cursor-pointer">
                                <input type="radio" wire:model.live="font_style" value="{{ $font['id'] }}" class="sr-only peer">
                                <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-brand-coral peer-checked:bg-white peer-checked:shadow-lg border-transparent bg-brand-slate/5 hover:bg-white">
                                    <span class="text-3xl font-bold text-brand-slate {{ $font['id'] == 'caveat' ? 'font-hand' : ($font['id'] == 'playfair' ? 'font-serif' : '') }}">{{ $font['preview'] }}</span>
                                    <p class="text-xs font-bold text-brand-slate/50 mt-2">{{ $font['name'] }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Layout Mode -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-4">Layout Foto</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([
                            ['id' => 'carousel', 'name' => 'Carousel', 'icon' => '📱'],
                            ['id' => 'grid', 'name' => 'Grid', 'icon' => '🖼️'],
                            ['id' => 'polaroid', 'name' => 'Polaroid', 'icon' => '📷']
                        ] as $layout)
                            <label class="cursor-pointer">
                                <input type="radio" wire:model.live="layout_mode" value="{{ $layout['id'] }}" class="sr-only peer">
                                <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-brand-coral peer-checked:bg-white peer-checked:shadow-lg border-transparent bg-brand-slate/5 hover:bg-white">
                                    <span class="text-2xl">{{ $layout['icon'] }}</span>
                                    <p class="text-xs font-bold text-brand-slate/50 mt-2">{{ $layout['name'] }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Theme Style -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-4">Efek Spesial</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([
                            ['id' => 'confetti', 'name' => 'Confetti', 'icon' => '🎉'],
                            ['id' => 'dark-romantic', 'name' => 'Romantic', 'icon' => '💝'],
                            ['id' => 'minimal', 'name' => 'Minimal', 'icon' => '✨']
                        ] as $theme)
                            <label class="cursor-pointer">
                                <input type="radio" wire:model.live="theme_style" value="{{ $theme['id'] }}" class="sr-only peer">
                                <div class="p-4 rounded-xl border-2 text-center transition-all peer-checked:border-brand-coral peer-checked:bg-white peer-checked:shadow-lg border-transparent bg-brand-slate/5 hover:bg-white">
                                    <span class="text-2xl">{{ $theme['icon'] }}</span>
                                    <p class="text-xs font-bold text-brand-slate/50 mt-2">{{ $theme['name'] }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Music (Optional) -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-4">
                        Background Music <span class="text-amber-500">(Premium)</span>
                    </label>
                    <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-dashed border-brand-slate/20 hover:border-brand-coral cursor-pointer transition-all">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-coral to-brand-orange flex items-center justify-center text-white text-xl shadow-lg">
                            🎵
                        </div>
                        <div class="flex-1">
                            @if($music_file)
                                <p class="font-bold text-brand-slate">{{ $music_file->getClientOriginalName() }}</p>
                                <p class="text-xs text-green-500 font-bold">Ready!</p>
                            @else
                                <p class="font-bold text-brand-slate">Upload Lagu</p>
                                <p class="text-xs text-brand-slate/50">MP3/WAV, Max 10MB</p>
                            @endif
                        </div>
                        <input wire:model="music_file" type="file" accept="audio/*" class="hidden">
                    </label>
                </div>

            </div>
        @endif

        <!-- TAB 3: FINISH -->
        @if($currentStep === 3)
            <div class="space-y-6 animate-fade-in">
                
                <!-- Custom Link -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-3">Custom Link</label>
                    <div class="flex items-center bg-brand-slate/5 rounded-xl px-4">
                        <span class="text-brand-slate/40 font-medium">momenku.com/</span>
                        <input wire:model="slug" type="text" 
                               class="flex-1 bg-transparent border-none focus:ring-0 py-4 text-brand-coral font-bold placeholder-brand-coral/30"
                               placeholder="link-kamu">
                    </div>
                    @error('slug') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Preview Card -->
                <div class="bg-white/70 backdrop-blur rounded-2xl p-6 shadow-lg border border-white/50">
                    <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-wider mb-4">Preview</label>
                    
                    <div class="aspect-[9/16] rounded-2xl overflow-hidden shadow-xl bg-gradient-to-br 
                        {{ $color_theme == 'sunset' ? 'from-rose-400 to-orange-400' : '' }}
                        {{ $color_theme == 'ocean' ? 'from-cyan-400 to-blue-500' : '' }}
                        {{ $color_theme == 'midnight' ? 'from-slate-800 to-purple-900' : '' }}
                        {{ $color_theme == 'candy' ? 'from-pink-400 to-purple-500' : '' }}
                        p-6 flex flex-col items-center justify-center text-center text-white">
                        
                        <h3 class="text-2xl font-bold {{ $font_style == 'caveat' ? 'font-hand' : ($font_style == 'playfair' ? 'font-serif' : '') }}">
                            {{ $title ?: 'Judul Kamu' }}
                        </h3>
                        <p class="text-sm opacity-80 mt-1">For {{ $recipient_name ?: 'Nama' }}</p>
                        
                        @if(count($photos) > 0)
                            <div class="w-20 h-20 rounded-xl bg-white/20 mt-4 overflow-hidden">
                                <img src="{{ $photos[0]->temporaryUrl() }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                        <p class="text-xs opacity-70 mt-4 line-clamp-3 {{ $font_style == 'caveat' ? 'font-hand' : ($font_style == 'playfair' ? 'font-serif' : '') }}">
                            {{ $message ?: 'Pesan kamu...' }}
                        </p>
                    </div>
                </div>

                <!-- Generate Button -->
                <button type="submit" wire:loading.attr="disabled"
                        class="w-full py-5 bg-gradient-to-r from-brand-coral to-brand-orange text-white font-bold text-xl rounded-2xl shadow-xl shadow-brand-coral/30 hover:shadow-2xl hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-3">
                    <span wire:loading.remove wire:target="submit">Generate Link 🚀</span>
                    <span wire:loading wire:target="submit" class="flex items-center gap-2">
                        <img src="{{ asset('images/loader.png') }}" class="w-6 h-6 animate-spin">
                        Generating...
                    </span>
                </button>

            </div>
        @endif

        <!-- NAVIGATION BUTTONS -->
        <div class="flex justify-between mt-8 gap-4">
            @if($currentStep > 1)
                <button wire:click="previousStep" type="button"
                        class="px-8 py-4 bg-white/70 backdrop-blur rounded-xl font-bold text-brand-slate shadow-lg hover:bg-white transition-all">
                    ← Kembali
                </button>
            @else
                <div></div>
            @endif

            @if($currentStep < 3)
                <button wire:click="nextStep" type="button"
                        class="px-8 py-4 bg-brand-slate text-white rounded-xl font-bold shadow-lg hover:bg-gray-800 transition-all flex items-center gap-2">
                    Lanjut →
                </button>
            @endif
        </div>

    </form>

    <!-- PREMIUM MODAL -->
    @if($showPremiumModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center px-4">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" wire:click="stayFree"></div>
            <div class="bg-white rounded-3xl p-8 max-w-sm w-full shadow-2xl relative">
                <div class="text-center space-y-4">
                    <span class="text-5xl">👑</span>
                    <h3 class="text-2xl font-black text-brand-slate">Upgrade Premium?</h3>
                    <p class="text-brand-slate/60">Unlock unlimited photos & custom music!</p>
                    
                    <button wire:click="goPremium" class="w-full py-4 bg-brand-slate text-white rounded-xl font-bold">
                        Upgrade Rp 10.000
                    </button>
                    <button wire:click="stayFree" class="w-full py-2 text-brand-slate/50 font-bold">
                        Pakai Gratis Aja
                    </button>
                </div>
            </div>
        </div>
    @endif

    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

</div>
