<?php

namespace App\Livewire;

use App\Models\Plant;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PlantEditForm extends Component
{
    use WithFileUploads;

    public Plant $plant;
    public $name;
    public $batch;
    public $notes;
    public $planted_at;
    public $insertion_date;
    public $farm_id;
    public $images = [];
    public $newImages = [];
    public $remove_images = [];
    public $type_ids = [];

    protected $listeners = ['typesUpdated' => 'setTypes'];

    protected $rules = [
        'name' => 'required|string|max:255',
        'batch' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
        'planted_at' => 'nullable|date',
        'insertion_date' => 'nullable|date',
        'farm_id' => 'required|exists:farms,id',
        'newImages.*' => 'nullable|image|max:2048',
    ];

    public function mount(Plant $plant): void
    {
        $this->plant = $plant->load('types');
        $this->name = $plant->name;
        $this->batch = $plant->batch;
        $this->notes = $plant->notes;
        $this->planted_at = optional($plant->planted_at)->toDateString();
        $this->insertion_date = optional($plant->insertion_date)->toDateString();
        $this->farm_id = $plant->farm_id;
        $this->images = $plant->images ?? [];
        $this->type_ids = $plant->types->pluck('id')->toArray();
    }

    public function setTypes($ids)
    {
        $this->type_ids = $ids ?: [];
    }

    public function removeImage(string $path)
    {
        Storage::disk('public')->delete($path);
        $this->images = array_values(array_filter($this->images, fn($i) => $i !== $path));
    }

    public function save()
    {
        $this->validate();

        $images = $this->images;

        // add new images
        foreach ($this->newImages as $image) {
            $images[] = $image->store('plants', 'public');
        }

        $this->plant->update([
            'name' => $this->name,
            'batch' => $this->batch,
            'notes' => $this->notes,
            'planted_at' => $this->planted_at,
            'insertion_date' => $this->insertion_date,
            'farm_id' => $this->farm_id,
            'images' => array_values($images),
        ]);

        // sync types
        $this->plant->types()->sync($this->type_ids);

        session()->flash('success', 'Plant updated');
        return redirect()->route('public.plants.show', $this->plant->plant_code);
    }

    public function render(): View
    {
        return view('livewire.plant-edit-form', [
            'farms' => auth()->user()->farms,
        ]);
    }
}
