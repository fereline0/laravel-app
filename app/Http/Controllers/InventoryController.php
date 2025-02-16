<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Device;
use App\Models\Cabinet;
use App\Http\Requests\InventoryRequest;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $sortOptions = [
            ['label' => 'Сначала новые', 'value' => 'desc'],
            ['label' => 'Сначала старые', 'value' => 'asc'],
        ];

        $query = Inventory::with(['device', 'cabinet']);

        if ($request->filled('device_id')) {
            $query->where('device_id', $request->device_id);
        }

        if ($request->filled('cabinet_id')) {
            $query->where('cabinet_id', $request->cabinet_id);
        }

        if ($request->filled('sort')) {
            $query->orderBy('created_at', $request->input('sort'));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $inventories = $query->paginate(20);

        $devices = Device::all()->map(function ($device) {
            return [
                'label' => $device->name,
                'value' => $device->id,
            ];
        });

        $cabinets = Cabinet::all()->map(function ($cabinet) {
            return [
                'label' => $cabinet->name,
                'value' => $cabinet->id,
            ];
        });

        return view('inventories.index', compact('inventories', 'devices', 'cabinets', 'sortOptions'));
    }

    public function create()
    {
        $devices = Device::all()->map(function ($device) {
            return [
                'label' => $device->name,
                'value' => $device->id,
            ];
        });

        $cabinets = Cabinet::all()->map(function ($cabinet) {
            return [
                'label' => $cabinet->name,
                'value' => $cabinet->id,
            ];
        });

        return view('inventories.create', compact('devices', 'cabinets'));
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $devices = Device::all()->map(function ($device) {
            return [
                'label' => $device->name,
                'value' => $device->id,
            ];
        });

        $cabinets = Cabinet::all()->map(function ($cabinet) {
            return [
                'label' => $cabinet->name,
                'value' => $cabinet->id,
            ];
        });

        return view('inventories.edit', compact('inventory', 'devices', 'cabinets'));
    }

    public function store(InventoryRequest $request)
    {
        Inventory::create($request->validated());
        return redirect()->route('dashboard.inventories.index');
    }

    public function update(InventoryRequest $request, $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->validated());
        return redirect()->route('dashboard.inventories.index');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->route('dashboard.inventories.index');
    }
}
