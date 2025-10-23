<?php

namespace App\Livewire;

use App\Models\Plant;
use App\Models\PlantUpdate;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class PlantUpdateManager extends Component
{
    use WithFileUploads;

    public Plant $plant;
    public string $viewMode = 'list'; // 'list' or 'calendar'

    // create/edit fields
    public $editingId = null;
    public string $title = '';
    public string $description = '';
    public string $height = '';
    public string $pests = '';
    public string $diseases = '';
    public $photos = [];

    protected $listeners = ['plantUpdated' => '$refresh'];

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
        $this->plant = $plant->load('updates');
    }

    public function switchView(string $mode): void
    {
        if (in_array($mode, ['list', 'calendar'])) {
            $this->viewMode = $mode;
        }
    }

    public function startEdit($id): void
    {
        $update = PlantUpdate::findOrFail($id);
        $this->editingId = $update->id;
        $this->title = $update->title;
        $this->description = $update->description;
        $this->height = $update->height;
        $this->pests = $update->pests;
        $this->diseases = $update->diseases;
    }

    public function cancelEdit(): void
    {
        $this->resetEditing();
    }

    protected function resetEditing(): void
    {
        $this->editingId = null;
        $this->reset(['title','description','height','pests','diseases','photos']);
    }

    public function save(): void
    {
        $this->validate();

        $stored = [];
        foreach ($this->photos as $photo) {
            $stored[] = $photo->store('updates', 'public');
        }

        if ($this->editingId) {
            $update = PlantUpdate::findOrFail($this->editingId);
            $update->update([
                'title' => $this->title,
                'description' => $this->description,
                'height' => $this->height,
                'pests' => $this->pests,
                'diseases' => $this->diseases,
            ]);

            if (!empty($stored)) {
                $merged = array_merge($update->photos ?? [], $stored);
                $update->update(['photos' => $merged]);
            }

            session()->flash('message', 'Update saved');
        } else {
            PlantUpdate::create([
                'plant_id' => $this->plant->id,
                'user_id' => auth()->id(),
                'status' => 'manual',
                'title' => $this->title,
                'description' => $this->description,
                'height' => $this->height,
                'pests' => $this->pests,
                'diseases' => $this->diseases,
                'photos' => $stored,
                'recorded_at' => now(),
            ]);

            session()->flash('message', 'Update created');
        }

        $this->resetEditing();
        $this->plant->refresh();
        $this->emit('plantUpdated');
    }

    public function delete($id): void
    {
        $update = PlantUpdate::findOrFail($id);
        $update->delete();
        session()->flash('message', 'Update deleted');
        $this->plant->refresh();
    }

    public function render(): View
    {
        $updates = $this->plant->updates()->with('user')->orderBy('recorded_at', 'desc')->get();

        return view('livewire.plant-update-manager', [
            'updates' => $updates,
        ]);
    }
}
