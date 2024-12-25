<?php

namespace App\View\Components;

use App\Models\ContactInfo;
use Illuminate\View\Component;
use Illuminate\View\View;

class FooterLayout extends Component
{
    public $contactInfo;

    public function __construct()
    {
        $this->contactInfo = ContactInfo::first();
    }

    public function render(): View
    {
        return view('layouts.footer', ['contactInfo' => $this->contactInfo]);
    }
}