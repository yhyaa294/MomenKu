<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex justify-between mb-2">
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full {{ $currentStep >= 1 ? 'text-indigo-600 bg-indigo-200' : 'text-gray-600 bg-gray-200' }}">
                Step 1: Info
            </span>
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full {{ $currentStep >= 2 ? 'text-indigo-600 bg-indigo-200' : 'text-gray-600 bg-gray-200' }}">
                Step 2: Content
            </span>
            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full {{ $currentStep >= 3 ? 'text-indigo-600 bg-indigo-200' : 'text-gray-600 bg-gray-200' }}">
                Step 3: Style
            </span>
        </div>
        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
            <div style="width: {{ ($currentStep / 3) * 100 }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500 transition-all duration-500"></div>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <!-- Step 1: Basic Info -->
        @if ($currentStep === 1)
            <div class="space-y-6">
                <h2 class="text-lg font-medium text-gray-900">Basic Information</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title</label>
                    <input wire:model.live="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" placeholder="Happy Birthday!">
                    @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Recipient Name</label>
                    <input wire:model="recipient_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" placeholder="Aura">
                    @error('recipient_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Page URL Slug</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            momenku.com/
                        </span>
                        <input wire:model="slug" type="text" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 border">
                    </div>
                    @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        @endif

        <!-- Step 2: Content -->
        @if ($currentStep === 2)
            <div class="space-y-6">
                <h2 class="text-lg font-medium text-gray-900">Add Content</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea wire:model="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" placeholder="Write your heartfelt message..."></textarea>
                    @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Upload Photos</label>
                    <input wire:model="photos" type="file" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <div wire:loading wire:target="photos">Uploading...</div>
                    @error('photos.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    
                    @if ($photos)
                        <div class="mt-4 grid grid-cols-3 gap-4">
                            @foreach ($photos as $photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="h-24 w-24 object-cover rounded">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Step 3: Customization -->
        @if ($currentStep === 3)
            <div class="space-y-6">
                <h2 class="text-lg font-medium text-gray-900">Customize</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Theme Style</label>
                    <select wire:model="theme_style" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md border">
                        <option value="confetti">Confetti (Fun & Bright)</option>
                        <option value="dark-romantic">Dark Romantic (Elegant)</option>
                        <option value="minimal">Minimal (Clean)</option>
                    </select>
                    @error('theme_style') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Background Music (Optional)</label>
                    <input wire:model="music_file" type="file" accept="audio/*" class="mt-1 block w-full text-sm text-gray-500">
                    <div wire:loading wire:target="music_file">Uploading...</div>
                    @error('music_file') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        @endif

        <!-- Navigation Buttons -->
        <div class="mt-8 flex justify-between">
            @if ($currentStep > 1)
                <button wire:click="previousStep" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Back
                </button>
            @else
                <div></div>
            @endif

            @if ($currentStep < 3)
                <button wire:click="nextStep" type="button" class="bg-indigo-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Next
                </button>
            @else
                <button wire:click="submit" type="button" class="bg-green-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Publish Page
                </button>
            @endif
        </div>
    </div>
</div>
