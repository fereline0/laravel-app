<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Http\Requests\RequestRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index(HttpRequest $request)
    {
        $sortOptions = [
            ['label' => 'Сначала новые', 'value' => 'desc'],
            ['label' => 'Сначала старые', 'value' => 'asc'],
        ];

        $query = Request::with('user');

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            $query->orderBy('created_at', $sort);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $requests = $query->paginate(20);

        return view('requests.index', compact('requests', 'sortOptions'));
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store(RequestRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        $validatedData['is_closed'] = false;

        Request::create($validatedData);

        return redirect()->route('requests.index');
    }

    public function show($id)
    {
        $request = Request::findOrFail($id);
        return view('requests.show', compact('request'));
    }

    public function toggleStatus($id)
    {
        $request = Request::findOrFail($id);
        $request->is_closed = !$request->is_closed;
        $request->save();

        return redirect()->route('requests.show', $request->id);
    }

    public function destroy($id)
    {
        $request = Request::findOrFail($id);
        $request->delete();

        return redirect()->route('dashboard.requests.index');
    }
}