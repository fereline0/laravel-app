<?php

namespace App\Http\Controllers;

use App\Models\Cabinet;
use App\Http\Requests\CabinetRequest;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public function index(Request $request)
    {
        $sortOptions = [
            ['label' => 'Сначала новые', 'value' => 'desc'],
            ['label' => 'Сначала старые', 'value' => 'asc'],
        ];

        $query = Cabinet::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            $query->orderBy('created_at', $sort);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $cabinets = $query->paginate(20);

        return view('cabinets.index', compact('cabinets', 'sortOptions'));
    }

    public function create()
    {
        return view('cabinets.create');
    }

    public function store(CabinetRequest $request)
    {
        Cabinet::create($request->validated());
        return redirect()->route('dashboard.cabinets.index');
    }

    public function edit($id)
    {
        $cabinet = Cabinet::findOrFail($id);

        return view('cabinets.edit', compact('cabinet'));
    }

    public function update(CabinetRequest $request, $id)
    {
        $cabinet = Cabinet::findOrFail($id);

        $cabinet->update($request->validated());
        return redirect()->route('dashboard.cabinets.index');
    }

    public function destroy($id)
    {
        $cabinet = Cabinet::findOrFail($id);

        $cabinet->delete();
        return redirect()->route('dashboard.cabinets.index');
    }
}
