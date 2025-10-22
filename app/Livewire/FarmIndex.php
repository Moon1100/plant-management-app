<?php

namespace App\Livewire;

use App\Models\Farm;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class FarmIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showOnlyOwned = false;

    public function mount(): void
    {
        $this->showOnlyOwned = auth()->check();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function toggleView(): void
    {
        $this->showOnlyOwned = !$this->showOnlyOwned;
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Farm::with('user', 'plants')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->showOnlyOwned && auth()->check(), fn($q) => $q->where('user_id', auth()->id()));

        $farms = $query->paginate(12);

        return view('livewire.farm-index', [
            'farms' => $farms,
            'isOwnerView' => $this->showOnlyOwned && auth()->check(),
        ]);
    }
}
