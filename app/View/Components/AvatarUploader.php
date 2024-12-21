<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AvatarUploader extends Component
{
    public $src;
    public $alt;
    public $initials;
    public $id;

    public function __construct($src = null, $alt = '', $initials = '', $id = 'image-input')
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->initials = $initials;
        $this->id = $id;
    }

    public function render()
    {
        return view('components.image-uploader');
    }
}
