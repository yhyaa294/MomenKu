<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Page;
use App\Models\PageMedia;
use App\Services\PaymentService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
    
    // Final
    public $generatedPageId;

    protected $rules = [
        1 => [
            'title' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
        ],
        2 => [
            'message' => 'required|string',
            'photos.*' => 'image|max:5120', // 5MB
        ],
        3 => [
            'theme_style' => 'required|in:confetti,dark-romantic,minimal',
            'music_file' => 'nullable|file|mimes:mp3,wav|max:10240', // 10MB
        ],
    ];

    public function updatedTitle()
    {
        if (!$this->slug) {
            $this->slug = Str::slug($this->title . '-' . Str::random(4));
        }
    }

    public function nextStep()
    {
        $this->validate($this->rules[$this->currentStep]);
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        // Final validation
        $this->validate($this->rules[1] + $this->rules[2] + $this->rules[3]);

        // Create Page
        $page = Page::create([
            'user_id' => Auth::id() ?? 1, // Fallback to 1 if not auth (dev only)
            'title' => $this->title,
            'recipient_name' => $this->recipient_name,
            'slug' => $this->slug,
            'message' => $this->message,
            'theme_style' => $this->theme_style,
            'music_url' => $this->music_file ? $this->music_file->store('music', 'public') : null,
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
        
        // Redirect to payment or show success
        // For this MVP, we redirect to the page
        return redirect()->route('page.show', ['slug' => $page->slug]);
    }

    public function render()
    {
        return view('livewire.page-builder');
    }
}
