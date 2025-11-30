<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Page;
use App\Models\PageMedia;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageBuilder extends Component
{
    use WithFileUploads;

    public $currentStep = 1;

    // Step 1
    public $title = '';
    public $recipient_name = '';
    public $slug = '';

    // Step 2
    public $message = '';
    public $photos = []; // Multiple files

    // Step 3
    public $theme_style = 'confetti';
    public $music_file; 
    
    // Step 4: Customization (New)
    public $font_style = 'outfit';
    public $color_theme = 'sunset';
    public $layout_mode = 'carousel';

    // Premium Logic
    public $isPremiumMode = false;
    public $showPremiumModal = false;

    // Final
    public $generatedPageId;

    protected $rules = [
        1 => [
            'title' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'message' => 'required|string',
            'photos.*' => 'nullable|image|max:10240',
        ],
        2 => [
            'color_theme' => 'nullable|string',
            'font_style' => 'nullable|string',
            'layout_mode' => 'nullable|string',
            'theme_style' => 'nullable|string',
            'music_file' => 'nullable|file|max:10240|mimes:mp3,wav',
        ],
        3 => [
            'slug' => 'required|string|max:255|unique:pages,slug',
        ],
    ];

    protected $messages = [
        'photos.*.max' => 'Foto kegedean! Maks 10MB ya.',
        'photos.*.image' => 'Hanya boleh upload gambar ya.',
        'music_file.max' => 'File musik maksimal 10MB.',
        'music_file.mimes' => 'Format musik harus MP3 atau WAV.',
        'slug.unique' => 'Link ini udah dipake orang lain, coba yang lain ya!',
    ];

    public function updatedTitle()
    {
        if (!$this->slug) {
            $this->slug = Str::slug($this->title . '-' . Str::random(4));
        }
    }

    public function updatedPhotos()
    {
        if (count($this->photos) > 3) {
            $this->triggerPremiumModal();
        }
    }

    public function updatedMusicFile()
    {
        if ($this->music_file) {
            $this->triggerPremiumModal();
        }
    }

    public function triggerPremiumModal()
    {
        if (!$this->isPremiumMode) {
            $this->showPremiumModal = true;
        }
    }

    public function goPremium()
    {
        $this->isPremiumMode = true;
        $this->showPremiumModal = false;
    }

    public function stayFree()
    {
        // Revert changes to free limits
        if (count($this->photos) > 3) {
            $this->photos = array_slice($this->photos, 0, 3);
        }
        
        $this->music_file = null;
        
        $this->isPremiumMode = false;
        $this->showPremiumModal = false;
    }

    public function goToStep($step)
    {
        // Allow going back freely, but validate before going forward
        if ($step > $this->currentStep) {
            $this->validate($this->rules[$this->currentStep] ?? []);
        }
        $this->currentStep = $step;
    }

    public function nextStep()
    {
        $this->validate($this->rules[$this->currentStep] ?? []);
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        // Final validation - merge all rules
        $this->validate($this->rules[1] + $this->rules[2] + $this->rules[3]);

        // Check if user is logged in, otherwise create a guest user
        $user = Auth::user();

        if (!$user) {
            // Create user silently
            $user = User::create([
                'name' => 'Guest ' . Str::random(5),
                'email' => 'guest.' . Str::random(8) . '@momenku.id',
                'password' => Hash::make('password123'), // Default password
            ]);
            
            // Log them in
            Auth::login($user);
        }

        // Create Page
        $page = Page::create([
            'user_id' => $user->id,
            'title' => $this->title,
            'recipient_name' => $this->recipient_name,
            'slug' => $this->slug,
            'message' => $this->message,
            'theme_style' => $this->theme_style,
            'music_url' => $this->music_file ? $this->music_file->store('music', 'public') : null,
            'is_premium' => false, // Default to false
            'font_style' => $this->font_style,
            'color_theme' => $this->color_theme,
            'layout_mode' => $this->layout_mode,
        ]);

        // Save Photos
        foreach ($this->photos as $index => $photo) {
            PageMedia::create([
                'page_id' => $page->id,
                'file_path' => $photo->store('photos', 'public'),
                'type' => 'image',
                'sort_order' => $index,
            ]);
        }

        $this->generatedPageId = $page->id;
        
        if ($this->isPremiumMode) {
            return redirect()->route('payment.checkout', ['page_id' => $page->id]);
        }

        return redirect()->route('page.show', ['slug' => $page->slug]);
    }

    public function render()
    {
        return view('livewire.page-builder');
    }
}
