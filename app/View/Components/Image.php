<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Image extends Component
{
    public $src;
    public $alt;
    public $initials;

    public function __construct($src = null, $alt = 'User  Image', $initials = null)
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->initials = $initials;
    }

    public function render()
    {
        return view('components.image');
    }
}
