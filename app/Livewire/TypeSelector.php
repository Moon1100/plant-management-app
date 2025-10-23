<?php

namespace App\Livewire;

use App\Models\Type;
use Livewire\Component;

class TypeSelector extends Component
{
    public $selected = [];
    public $query = '';
    public $newName = '';

    protected $listeners = ['setSelectedTypes'];

    public function mount($selected = [])
    {
        $this->selected = $selected;
    }

    public function setSelectedTypes($ids)
    {
        $this->selected = $ids;
    }

    public function toggle($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_values(array_filter($this->selected, fn($i) => $i != $id));
        } else {
            $this->selected[] = $id;
        }

        $this->emitUp('typesUpdated', $this->selected);
    }

    public function createNew()
    {
        $name = trim($this->newName);
        if ($name === '') return;

        $code = strtoupper(preg_replace('/[^A-Z0-9]+/i', '', substr($name, 0, 6)));

        $type = Type::create([
            'icon' => '',
            'name_en' => $name,
            'name_my' => null,
            'code' => $code . time()%1000,
        ]);

        $this->newName = '';
        $this->selected[] = $type->id;
        $this->emitUp('typesUpdated', $this->selected);
    }

    public function getResultsProperty()
    {
        $q = trim($this->query);
        $query = Type::query();
        if ($q !== '') {
            $query->where('name_en', 'like', "%{$q}%")->orWhere('code', 'like', "%{$q}%");
        }
        return $query->orderBy('name_en')->limit(50)->get();
    }

    public function render()
    {
        return view('livewire.type-selector', [
            'results' => $this->results,
        ]);
    }
}
