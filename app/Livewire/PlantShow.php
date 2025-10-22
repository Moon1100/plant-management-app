<?php

namespace App\Livewire;

use App\Models\Plant;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PlantShow extends Component
{
    use WithPagination;

    public Plant $plant;
    public bool $showQrCode = false;

    public function mount(Plant $plant): void
    {
        $this->plant = $plant->load('farm.user');
    }

    public function toggleQrCode(): void
    {
        $this->showQrCode = !$this->showQrCode;

        if ($this->showQrCode && !$this->plant->qr_code_path) {
            $this->plant->generateQrCode();
            $this->plant->refresh();
        }
    }

    public function generateQrCode(): void
    {
        $this->plant->generateQrCode();
        $this->plant->refresh();
        $this->showQrCode = true;
        session()->flash('message', 'QR Code generated successfully!');
    }

    public function render(): View
    {
        $updates = $this->plant->updates()
            ->with('user')
            ->paginate(10);

        return view('livewire.plant-show', [
            'updates' => $updates,
            'isOwner' => auth()->check() && auth()->id() === $this->plant->farm->user_id,
        ]);
    }
}
