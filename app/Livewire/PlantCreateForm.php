<?php

namespace App\Livewire;

use App\Models\Plant;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class PlantCreateForm extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $batch = '';
    public string $notes = '';
    public $planted_at = '';
    public $insertion_date = '';
    public $farm_id = '';
    public $newImages = [];

    protected array $rules = [
        'name' => 'required|string|max:255',
        'batch' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
        'planted_at' => 'nullable|date',
        'insertion_date' => 'required|date',
        'farm_id' => 'required|exists:farms,id',
        'newImages.*' => 'nullable|image|max:2048',
    ];

    public function mount(): void
    {
        // sensible defaults
        $this->insertion_date = now()->toDateString();

        if (!$this->farm_id && auth()->check() && auth()->user()->farms()->count() === 1) {
            $this->farm_id = auth()->user()->farms()->first()->id;
        }
    }

    public function removeNewImage(int $index): void
    {
        unset($this->newImages[$index]);
        $this->newImages = array_values($this->newImages);
    }

    public function save()
    {
        $this->validate();

        $images = [];

        foreach ($this->newImages as $image) {
            $path = $image->store('plants', 'public');
            $images[] = $path;
        }

        $data = [
            'name' => $this->name,
            'batch' => $this->batch,
            'notes' => $this->notes,
            'planted_at' => $this->planted_at,
            'insertion_date' => $this->insertion_date ?: now()->toDateString(),
            'farm_id' => $this->farm_id,
            'images' => $images,
        ];

        $plant = new Plant($data);
        $plant->save();

        session()->flash('message', 'Plant created successfully!');

        // Redirect to public show if plant_code available, otherwise to farms.index
        if (!empty($plant->plant_code) && \Illuminate\Support\Facades\Route::has('public.plants.show')) {
            return redirect()->route('public.plants.show', $plant->plant_code);
        }

        return redirect()->route('farms.index');
    }

    public function render(): View
    {
        return view('livewire.plant-create-form', [
            'farms' => auth()->check() ? auth()->user()->farms : collect([]),
        ]);
    }
}
