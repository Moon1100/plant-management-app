<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class PlantIcon extends Component
{
    public $plant;

    public function __construct($plant)
    {
        $this->plant = $plant;
    }

    public function render()
    {
        $type = optional($this->plant->types->first());
        $icon = $type->icon ?? '🌿';

        // Determine if it's an image file
        $isImage = Str::endsWith($icon, ['.png', '.jpg', '.jpeg', '.svg', '.gif','.webp']);


        return view('components.plant-icon', [
            'icon' => $icon,
            'isImage' => $isImage,
        ]);
    }
}
