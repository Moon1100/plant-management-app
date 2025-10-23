<?php

namespace App\Livewire;

use App\Models\Plant;
use App\Models\PlantUpdate;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class PlantUpdateForm extends Component
{
    use WithFileUploads;

    public Plant $plant;
    public string $title = '';
    public string $description = '';
    public string $height = '';
    public string $pests = '';
    public string $diseases = '';
    public $photos = [];

    protected array $rules = [
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'height' => 'nullable|string|max:255',
        'pests' => 'nullable|string|max:255',
        'diseases' => 'nullable|string|max:255',
        'photos.*' => 'nullable|image|max:2048',
    ];

    public function mount(Plant $plant): void
    {
        $this->plant = $plant;
    }

    public function saveUpdate(): void
    {
        $this->validate();

        $stored = [];
        foreach ($this->photos as $photo) {
            $stored[] = $photo->store('updates', 'public');
        }

        PlantUpdate::create([
            'plant_id' => $this->plant->id,
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'height' => $this->height,
            'pests' => $this->pests,
            'diseases' => $this->diseases,
            'photos' => $stored,
            'recorded_at' => now(),
        ]);

        session()->flash('message', 'Update recorded');
        $this->reset(['title','description','height','pests','diseases','photos']);
        $this->emit('plantUpdated');
    }

    public function render(): View
    {
        return view('livewire.plant-update-form');
    }
}
