<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Category;
use App\Http\Requests\DeviceRequest;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $sortOptions = [
            ['label' => 'Сначала новые', 'value' => 'desc'],
            ['label' => 'Сначала старые', 'value' => 'asc'],
        ];

        $query = Device::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('serial_number', 'like', "%{$search}%");
        }

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            $query->orderBy('created_at', $sort);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $devices = $query->paginate(20);

        return view('devices.index', compact('devices', 'sortOptions'));
    }

    public function create()
    {
        $categories = Category::all()->map(function ($category) {
            return [
                'label' => $category->name,
                'value' => $category->id,
            ];
        });

        return view('devices.create', compact('categories'));
    }

    public function edit($id)
    {
        $device = Device::findOrFail($id);
        $categories = Category::all()->map(function ($category) {
            return [
                'label' => $category->name,
                'value' => $category->id,
            ];
        });

        return view('devices.edit', compact('device', 'categories'));
    }

    public function store(DeviceRequest $request)
    {
        Device::create($request->validated());
        return redirect()->route('dashboard.devices.index');
    }

    public function update(DeviceRequest $request, $id)
    {
        $device = Device::findOrFail($id);

        $device->update($request->validated());
        return redirect()->route('dashboard.devices.index');
    }

    public function destroy($id)
    {
        $device = Device::findOrFail($id);

        $device->delete();
        return redirect()->route('dashboard.devices.index');
    }
}
