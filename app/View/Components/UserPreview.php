<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserPreview extends Component
{
    public $name;
    public $description;
    public $href;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $description, $href)
    {
        $this->name = $name;
        $this->description = $description;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-preview');
    }
}
