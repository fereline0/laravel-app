<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DashboardLayout extends Component
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function render(): View
    {
        $user = $this->request->user();

        $tabs = [
            [
                "url" => "dashboard.announcements.index",
                "label" => "Объявления",
                "permissions" => ['view announcement', 'create announcement', 'edit announcement', 'delete announcement'],
            ],
            [
                "url" => "dashboard.passwords.index",
                "label" => "Пароли",
                "permissions" => ['view password', 'create password', 'edit password', 'delete password'],
            ],
            [
                "url" => "dashboard.categories.index",
                "label" => "Категории",
                "permissions" => ['view category', 'create category', 'edit category', 'delete category'],
            ],
            [
                "url" => "dashboard.cabinets.index",
                "label" => "Кабинеты",
                "permissions" => ['view cabinet', 'create cabinet', 'edit cabinet', 'delete cabinet'],
            ],
            [
                "url" => "dashboard.devices.index",
                "label" => "Устройства",
                "permissions" => ['view device', 'create device', 'edit device', 'delete device'],
            ],
            [
                "url" => "dashboard.inventories.index",
                "label" => "Инвенторизации",
                "permissions" => ['view inventory', 'create inventory', 'edit inventory', 'delete inventory'],
            ]
        ];

        $tabs = array_filter($tabs, function ($tab) use ($user) {
            return $user && $user->hasAnyPermission($tab['permissions']);
        });

        return view('layouts.dashboard', compact('tabs'));
    }
}
