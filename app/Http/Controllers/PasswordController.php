<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function index(Request $request)
    {
        $sortOptions = [
            ['label' => 'Сначала новые', 'value' => 'desc'],
            ['label' => 'Сначала старые', 'value' => 'asc'],
        ];

        $userId = Auth::id();
        $query = Password::where(function ($query) use ($userId) {
            $query->where('privacy', false)
                ->orWhere('user_id', $userId);
        });

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('source', 'like', "%{$search}%")
                    ->orWhere('value', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            $query->orderBy('created_at', $sort);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $passwords = $query->paginate(20);

        return view('passwords.index', compact('passwords', 'sortOptions'));
    }

    public function show($id)
    {
        $password = Password::findOrFail($id);

        return view('passwords.show', compact('password'));
    }

    public function create()
    {
        return view('passwords.create');
    }

    public function store(PasswordRequest $request)
    {
        Password::create([
            'user_id' => $request->user()->id,
            'source' => $request->source,
            'value' => $request->value,
            'privacy' => $request->input('privacy', 0),
        ]);

        return redirect()->route('dashboard.passwords.index');
    }

    public function edit($id)
    {
        $password = Password::findOrFail($id);
        return view('passwords.edit', compact('password'));
    }

    public function update(PasswordRequest $request, $id)
    {
        $password = Password::findOrFail($id);
        $password->update([
            'source' => $request->source,
            'value' => $request->value,
            'privacy' => $request->input('privacy', 0),
        ]);

        return redirect()->route('dashboard.passwords.index');
    }

    public function destroy($id)
    {
        $password = Password::findOrFail($id);
        $password->delete();

        return redirect()->route('dashboard.passwords.index');
    }
}
