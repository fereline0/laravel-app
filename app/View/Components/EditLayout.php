<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class EditLayout extends Component
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function render(): View
    {
        $links = [
            ['name' => 'Общие', 'url' => route('users.edit.general', ['id' => $this->user->id]), 'availability' => null],
            ['name' => 'Смена пароля', 'url' => route('users.edit.update-password', ['id' => $this->user->id]), 'availability' => 'canSeeAllEditActions'],
            ['name' => 'Детальная информация', 'url' => route('users.edit.detail-information', ['id' => $this->user->id]), 'availability' => null],
            ['name' => 'Удаление аккаунта', 'url' => route('users.edit.delete-account', ['id' => $this->user->id]), 'availability' => 'canSeeAllEditActions'],
        ];

        return view('layouts.edit', [
            'links' => $links,
            'user' => $this->user,
        ]);
    }
}