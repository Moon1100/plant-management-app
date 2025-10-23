<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Plant;
use App\Models\PlantUpdate;

class PlantUpdateModal extends ModalComponent
{
    use WithFileUploads;

    public $plant;
    // form fields
    public $title;
    public $description;
    public $status;
    public $recorded_at;
    public $photos = [];
    // no listeners: modal is opened via LivewireUI's Modal::show('plant-update-modal', [...])

    protected $rules = [
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'status' => 'nullable|string|max:255',
        'recorded_at' => 'nullable|date',
        'photos.*' => 'image|max:2048', // 2MB each
    ];

    /**
     * Mount accepts either a Plant model or a plant id (from LivewireUI params).
     */
    public function mount($plant)
    {
        if ($plant instanceof Plant) {
            $this->plant = $plant;
        } else {
            $this->plant = Plant::findOrFail($plant);
        }
    }

    public function close()
    {
        // helper to close the LivewireUI modal
        $this->resetExcept('plant');
        $this->closeModal();
    }

    public function save()
    {
        $this->validate();

        $update = new PlantUpdate();
        $update->plant_id = $this->plant->id;
        $update->user_id = auth()->id();
        $update->title = $this->title;
        $update->description = $this->description;
        $update->status = $this->status;
        $update->recorded_at = $this->recorded_at ?? now();

        // save photos
        $paths = [];
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $paths[] = $photo->store("plants/{$this->plant->id}/updates", 'public');
            }
            $update->photos = $paths;
        }

        $update->save();

        return redirect()->route('public.plants.show', $this->plant->plant_code)
            ->with('success', 'Update added successfully!');
    }

    public function render()
    {
        return view('livewire.plant-update-modal');
    }
}
