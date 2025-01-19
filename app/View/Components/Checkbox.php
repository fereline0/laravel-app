<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $id;
    public $name;
    public $value;
    public $label;
    public $checked;

    public function __construct($id, $name, $value = null, $label = '', $checked = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->checked = $checked;
    }

    public function render()
    {
        return view('components.checkbox');
    }
}
