<?php

namespace App\Livewire;

use App\Models\Farm;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class FarmShow extends Component
{
    use WithPagination;

    public Farm $farm;
    public string $search = '';
    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';

    public function mount(Farm $farm): void
    {
        $this->farm = $farm;
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function render(): View
    {
        $plants = $this->farm->plants()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(16);

        return view('livewire.farm-show', [
            'plants' => $plants,
            'isOwner' => auth()->check() && auth()->id() === $this->farm->user_id,
        ]);
    }
}
