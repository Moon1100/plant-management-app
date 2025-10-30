<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class TypeIcon extends Component
{
    /**
     * Create a new component instance.
     */
        public $type;


    public function __construct($type)
    {
                $this->type = $type;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {


        $icon = $this->type->icon ?? '🌿';


        // Determine if it's an image file
        $isImage = Str::endsWith($icon, ['.png', '.jpg', '.jpeg', '.svg', '.gif','.webp']);


        return view('components.type-icon', [
            'icon' => $icon,
            'isImage' => $isImage,
        ]);
    }
}
