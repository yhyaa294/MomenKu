<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 h-full min-h-screen">
    
    <!-- LEFT COLUMN: WIZARD FORM -->
    <div class="w-full lg:col-span-5 lg:py-12 lg:pl-12 relative z-10 flex flex-col justify-center">
        <!-- Progress Indicator (Mobile: Fixed Top, Desktop: Inline) -->
        <div class="fixed top-[80px] left-0 w-full h-1 z-40 opacity-50 lg:hidden">
            <div class="h-full bg-gradient-to-r from-brand-coral to-brand-orange transition-all duration-500 ease-out rounded-r-full shadow-[0_0_10px_rgba(255,107,107,0.5)]"
                 style="width: {{ ($currentStep / 3) * 100 }}%"></div>
        </div>
        
        <!-- Desktop Steps Progress Bar -->
        <div class="hidden lg:block mb-12">
            <div class="flex items-center justify-between mb-2 text-xs font-bold uppercase tracking-widest text-brand-slate/40">
                <span class="{{ $currentStep >= 1 ? 'text-brand-coral' : '' }}">Basics</span>
                <span class="{{ $currentStep >= 2 ? 'text-brand-coral' : '' }}">Memories</span>
                <span class="{{ $currentStep >= 3 ? 'text-brand-coral' : '' }}">Vibe</span>
            </div>
            <div class="h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-brand-coral to-brand-orange transition-all duration-500 ease-out"
                     style="width: {{ ($currentStep / 3) * 100 }}%"></div>
            </div>
        </div>

        <form wire:submit.prevent="submit" class="space-y-8">
            <!-- Step 1: The Hook -->
            @if ($currentStep === 1)
                <div class="space-y-8 animate-fade-in-up">
                    <div class="text-center lg:text-left space-y-2">
                        <h2 class="text-4xl lg:text-5xl font-extrabold text-brand-slate tracking-tight">✨ Bikin Momen Spesial</h2>
                        <p class="text-lg text-brand-slate/60 font-medium">Siapa yang mau kamu surprise-in?</p>
                    </div>

                    <div class="space-y-10">
                        <!-- Big Title Input -->
                        <div class="relative group">
                            <input wire:model.live="title" type="text" 
                                   class="w-full text-6xl font-black text-center lg:text-left text-brand-slate border-none focus:ring-0 placeholder-brand-slate/10 bg-transparent leading-none tracking-tight lg:px-0 outline-none" 
                                   placeholder="Happy Birthday!">
                            
                            <!-- Dynamic Underline -->
                            <div class="h-2 w-32 mx-auto lg:mx-0 bg-brand-coral/20 rounded-full mt-4 group-hover:w-48 group-hover:bg-brand-coral transition-all duration-300"></div>
                            
                            @error('title') <p class="text-brand-coral text-center lg:text-left text-sm font-bold mt-2 bg-white/50 inline-block px-3 py-1 rounded-full table">{{ $message }}</p> @enderror
                        </div>

                        <!-- Glass Card Container for Details -->
                        <div class="glass rounded-[2rem] p-8 space-y-8 shadow-2xl border border-white/50 backdrop-blur-xl">
                            <!-- Recipient -->
                            <div class="space-y-3">
                                <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-widest ml-1">Buat Siapa?</label>
                                <input wire:model="recipient_name" type="text" 
                                       class="w-full border-transparent focus:border-brand-coral focus:ring-brand-coral rounded-2xl bg-white/60 px-6 py-4 text-xl font-bold text-brand-slate placeholder-brand-slate/30 shadow-sm transition-all" 
                                       placeholder="Nama Doi / Bestie">
                                @error('recipient_name') <span class="text-brand-coral text-xs font-bold">{{ $message }}</span> @enderror
                            </div>

                            <!-- Slug -->
                            <div class="space-y-3">
                                <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-widest ml-1">Custom Link</label>
                                <div class="flex items-center bg-white/60 rounded-2xl px-6 shadow-sm focus-within:ring-2 focus-within:ring-brand-coral transition-all">
                                    <span class="text-sm font-medium text-brand-slate/50 mr-1">momenku.com/</span>
                                    <input wire:model="slug" type="text" 
                                           class="flex-1 bg-transparent border-none focus:ring-0 py-4 px-0 text-brand-coral font-bold placeholder-brand-coral/30"
                                           placeholder="special-day">
                                </div>
                                @error('slug') <span class="text-brand-coral text-xs font-bold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Step 2: The Memories -->
            @if ($currentStep === 2)
                <div class="space-y-8 animate-fade-in-up">
                    <div class="text-center lg:text-left space-y-2">
                        <h2 class="text-4xl lg:text-5xl font-extrabold text-brand-slate">Tulis & Upload 📸</h2>
                        <p class="text-lg text-brand-slate/60 font-medium">Kasih ucapan & foto terbaik kalian!</p>
                    </div>

                    <!-- Glass Card Container -->
                    <div class="glass rounded-[2rem] p-8 space-y-8 shadow-2xl border border-white/50 backdrop-blur-xl">
                        <!-- Message -->
                        <div class="space-y-3">
                            <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-widest ml-1">Ucapan Manis</label>
                            <textarea wire:model.live="message" rows="5" 
                                      class="w-full border-transparent focus:border-brand-coral focus:ring-brand-coral rounded-2xl bg-white/60 p-6 text-brand-slate font-medium placeholder-brand-slate/30 shadow-sm resize-none leading-relaxed text-lg" 
                                      placeholder="Tulis harapan, doa, atau inside joke kalian di sini..."></textarea>
                            @error('message') <span class="text-brand-coral text-xs font-bold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Photo Upload -->
                        <div class="space-y-4">
                            <label class="block w-full aspect-[4/3] rounded-2xl border-2 border-dashed border-brand-coral/30 bg-brand-cream hover:bg-white hover:border-brand-coral transition-all duration-300 flex flex-col items-center justify-center cursor-pointer group relative overflow-hidden">
                                <input wire:model="photos" type="file" multiple class="hidden" accept="image/*">
                                
                                <!-- Loading State -->
                                <div wire:loading wire:target="photos" class="absolute inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center z-20">
                                    <div class="flex flex-col items-center">
                                        <svg class="animate-spin h-10 w-10 text-brand-coral mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span class="text-xs font-bold text-brand-coral">Uploading...</span>
                                    </div>
                                </div>

                                <div class="text-center p-6 group-hover:scale-110 transition-transform duration-300">
                                    <div class="mx-auto h-16 w-16 bg-brand-coral/10 rounded-full flex items-center justify-center mb-3 group-hover:bg-brand-coral/20 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-brand-coral">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-brand-slate font-bold">Pilih Foto-foto Seru</p>
                                    <p class="text-xs text-brand-slate/50 mt-1">Bisa banyak sekaligus lho!</p>
                                </div>
                            </label>
                            @error('photos.*') <span class="text-brand-coral text-xs font-bold">{{ $message }}</span> @enderror

                            <!-- Photo Grid -->
                            @if ($photos)
                                <div class="grid grid-cols-3 gap-3 animate-fade-in-up">
                                    @foreach ($photos as $photo)
                                        <div class="relative aspect-square rounded-2xl overflow-hidden shadow-md group hover:rotate-1 transition-transform">
                                            <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Step 3: The Vibe -->
            @if ($currentStep === 3)
                <div class="space-y-8 animate-fade-in-up pb-24 lg:pb-0">
                    <div class="text-center lg:text-left space-y-2">
                        <h2 class="text-4xl lg:text-5xl font-extrabold text-brand-slate">Pilih Vibe-nya 🎨</h2>
                        <p class="text-lg text-brand-slate/60 font-medium">Biar makin aesthetic!</p>
                    </div>

                    <div class="glass rounded-[2rem] p-8 space-y-8 shadow-2xl border border-white/50 backdrop-blur-xl">
                        <!-- Theme Selection -->
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Confetti -->
                            <label class="relative flex items-center p-4 cursor-pointer rounded-2xl border-2 transition-all duration-300 group {{ $theme_style === 'confetti' ? 'border-brand-coral bg-brand-coral/5 shadow-lg scale-[1.02]' : 'border-transparent bg-white/60 hover:bg-white hover:shadow-md' }}">
                                <input type="radio" wire:model.live="theme_style" value="confetti" class="sr-only">
                                <div class="h-14 w-14 rounded-full bg-yellow-100 flex items-center justify-center text-3xl mr-5 shadow-sm group-hover:scale-110 transition-transform">🎉</div>
                                <div class="flex-1">
                                    <h3 class="font-extrabold text-brand-slate text-lg">Confetti Party</h3>
                                    <p class="text-xs text-brand-slate/60 font-medium">Rame, seru, penuh warna!</p>
                                </div>
                                <div class="w-6 h-6 rounded-full border-2 border-brand-slate/20 flex items-center justify-center {{ $theme_style === 'confetti' ? 'bg-brand-coral border-brand-coral' : '' }}">
                                    @if($theme_style === 'confetti') <div class="w-2.5 h-2.5 rounded-full bg-white"></div> @endif
                                </div>
                            </label>

                            <!-- Dark Romantic -->
                            <label class="relative flex items-center p-4 cursor-pointer rounded-2xl border-2 transition-all duration-300 group {{ $theme_style === 'dark-romantic' ? 'border-brand-slate bg-brand-slate/5 shadow-lg scale-[1.02]' : 'border-transparent bg-white/60 hover:bg-white hover:shadow-md' }}">
                                <input type="radio" wire:model.live="theme_style" value="dark-romantic" class="sr-only">
                                <div class="h-14 w-14 rounded-full bg-brand-slate text-white flex items-center justify-center text-3xl mr-5 shadow-sm group-hover:scale-110 transition-transform">🌙</div>
                                <div class="flex-1">
                                    <h3 class="font-extrabold text-brand-slate text-lg">Dark Aesthetic</h3>
                                    <p class="text-xs text-brand-slate/60 font-medium">Elegan, misterius, classy</p>
                                </div>
                                <div class="w-6 h-6 rounded-full border-2 border-brand-slate/20 flex items-center justify-center {{ $theme_style === 'dark-romantic' ? 'bg-brand-slate border-brand-slate' : '' }}">
                                    @if($theme_style === 'dark-romantic') <div class="w-2.5 h-2.5 rounded-full bg-white"></div> @endif
                                </div>
                            </label>

                            <!-- Minimal -->
                            <label class="relative flex items-center p-4 cursor-pointer rounded-2xl border-2 transition-all duration-300 group {{ $theme_style === 'minimal' ? 'border-gray-400 bg-gray-50 shadow-lg scale-[1.02]' : 'border-transparent bg-white/60 hover:bg-white hover:shadow-md' }}">
                                <input type="radio" wire:model.live="theme_style" value="minimal" class="sr-only">
                                <div class="h-14 w-14 rounded-full bg-white border border-gray-100 flex items-center justify-center text-3xl mr-5 shadow-sm group-hover:scale-110 transition-transform">✨</div>
                                <div class="flex-1">
                                    <h3 class="font-extrabold text-brand-slate text-lg">Clean Minimal</h3>
                                    <p class="text-xs text-brand-slate/60 font-medium">Simpel, rapi, bersih</p>
                                </div>
                                <div class="w-6 h-6 rounded-full border-2 border-brand-slate/20 flex items-center justify-center {{ $theme_style === 'minimal' ? 'bg-gray-400 border-gray-400' : '' }}">
                                    @if($theme_style === 'minimal') <div class="w-2.5 h-2.5 rounded-full bg-white"></div> @endif
                                </div>
                            </label>
                        </div>

                        <!-- Music Upload -->
                        <div class="space-y-3">
                            <label class="block text-xs font-bold text-brand-slate/50 uppercase tracking-widest ml-1">Background Music</label>
                            <div class="relative">
                                <input wire:model="music_file" type="file" accept="audio/*" 
                                       class="block w-full text-sm text-brand-slate/70 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-brand-coral/10 file:text-brand-coral hover:file:bg-brand-coral/20 cursor-pointer bg-white/60 rounded-full pl-1 transition-colors">
                                <div wire:loading wire:target="music_file" class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-brand-coral animate-pulse">Uploading...</div>
                            </div>
                             @error('music_file') <span class="text-brand-coral text-xs font-bold">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            @endif

            <!-- Navigation Actions -->
            <div class="fixed bottom-0 left-0 w-full p-6 z-50 lg:static lg:p-0 lg:mt-12 lg:bg-transparent pointer-events-none lg:pointer-events-auto">
                <div class="max-w-md mx-auto lg:max-w-none flex justify-between items-center gap-6 pointer-events-auto">
                    @if ($currentStep > 1)
                        <button wire:click="previousStep" type="button" 
                                class="h-16 w-16 rounded-full bg-white shadow-lg border border-white/50 text-brand-slate flex items-center justify-center hover:scale-105 active:scale-95 transition-all backdrop-blur-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                        </button>
                    @else
                        <div class="w-16"></div> <!-- Spacer -->
                    @endif

                    @if ($currentStep < 3)
                        <button wire:click="nextStep" type="button" 
                                class="flex-1 bg-brand-slate text-white h-16 rounded-full font-bold text-xl shadow-xl hover:bg-gray-800 hover:shadow-2xl hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-3 group">
                            Lanjut
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 group-hover:translate-x-1 transition-transform">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    @else
                        <button type="submit" wire:loading.attr="disabled"
                                class="relative z-50 flex-1 bg-gradient-to-r from-brand-coral to-brand-orange text-white h-16 rounded-full font-extrabold text-xl shadow-xl shadow-brand-orange/30 hover:shadow-2xl hover:shadow-brand-orange/50 hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-3 group">
                            <span wire:loading.remove wire:target="submit">
                                {{ $isPremiumMode ? 'Checkout Premium 💎' : 'Gas Bikin! 🚀' }}
                            </span>
                            <span wire:loading wire:target="submit">Sabar ya...</span>
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- RIGHT COLUMN: STICKY MOBILE PREVIEW (Desktop Only) -->
    <div class="lg:col-span-7 hidden lg:flex items-center justify-center relative sticky top-0 h-screen p-8">
        <!-- Phone Frame -->
        <div class="max-h-[90vh] w-auto aspect-[9/19] shadow-2xl rounded-[3rem] border-8 border-gray-800 overflow-hidden relative bg-white ring-8 ring-black/5">
            <!-- Notch -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-32 h-6 bg-gray-800 rounded-b-2xl z-50"></div>
            
            <!-- Screen Content -->
            <div class="w-full h-full overflow-y-auto no-scrollbar 
                {{ $theme_style === 'confetti' ? 'bg-gradient-to-br from-yellow-50 via-pink-50 to-indigo-50' : '' }}
                {{ $theme_style === 'dark-romantic' ? 'bg-gray-900 text-white' : '' }}
                {{ $theme_style === 'minimal' ? 'bg-white text-gray-800' : '' }}">
                
                <div class="p-6 pt-12 text-center space-y-8">
                    <div class="space-y-1">
                        <h1 class="text-3xl font-bold leading-tight {{ $title ? '' : 'opacity-30' }}">{{ $title ?: 'Happy Birthday' }}</h1>
                        <p class="opacity-60 italic text-sm">For {{ $recipient_name ?: 'Someone' }}</p>
                    </div>

                    @if(count($photos) > 0)
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($photos as $photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="w-full aspect-square object-cover rounded-lg">
                            @endforeach
                        </div>
                    @else
                        <div class="w-full aspect-square bg-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300">
                            <span class="text-xs text-gray-400">Photo Preview</span>
                        </div>
                    @endif

                    <div class="text-sm opacity-80 whitespace-pre-wrap font-medium {{ $message ? '' : 'opacity-30' }}">
                        {{ $message ?: 'Your message will appear here...' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Modal -->
    @if($showPremiumModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center px-4">
            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="stayFree"></div>
            <div class="bg-white rounded-3xl p-8 max-w-sm w-full shadow-2xl relative animate-fade-in-up overflow-hidden">
                <!-- Gold Gradient Bg -->
                <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-yellow-200 via-yellow-100 to-white opacity-50"></div>
                
                <div class="relative text-center space-y-6">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto text-3xl shadow-sm">
                        👑
                    </div>
                    
                    <div class="space-y-2">
                        <h3 class="text-2xl font-extrabold text-brand-slate">Upgrade Premium?</h3>
                        <p class="text-sm text-brand-slate/60 leading-relaxed">
                            Kamu upload lebih dari 3 foto atau pakai musik custom.
                        </p>
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-2xl border border-yellow-200 text-left space-y-3">
                        <div class="flex items-center gap-3 text-sm font-bold text-brand-slate">
                            <span class="text-green-500">✓</span> Unlimited Photos
                        </div>
                        <div class="flex items-center gap-3 text-sm font-bold text-brand-slate">
                            <span class="text-green-500">✓</span> Custom Music
                        </div>
                        <div class="flex items-center gap-3 text-sm font-bold text-brand-slate">
                            <span class="text-green-500">✓</span> No Watermark
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button wire:click="goPremium" class="w-full py-4 rounded-xl bg-brand-slate text-white font-bold shadow-lg hover:bg-gray-800 transition-all transform hover:scale-105">
                            Upgrade (Rp 10.000)
                        </button>
                        <button wire:click="stayFree" class="block w-full py-2 text-sm font-bold text-brand-slate/40 hover:text-brand-slate transition-colors">
                            Pakai Versi Gratis Aja
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

