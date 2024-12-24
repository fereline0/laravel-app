<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    public function render(): View
    {
        $links = [
            ['name' => 'Пользователи', 'url' => route('admin.users')],
            ['name' => 'Категории', 'url' => route('admin.categories')],
            ['name' => 'Издательства', 'url' => route('admin.publishers')],
            ['name' => 'Авторы', 'url' => route('admin.authors')],
            ['name' => 'Книги', 'url' => route('admin.books')],
        ];

        return view('layouts.admin', compact('links'));
    }
}
