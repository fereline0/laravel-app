<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $sortOptions = [
            ['label' => 'Сначала новые', 'value' => 'desc'],
            ['label' => 'Сначала старые', 'value' => 'asc'],
        ];

        $query = Announcement::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('value', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            $query->orderBy('created_at', $sort);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $announcements = $query->paginate(20);

        return view('index', compact('announcements', 'sortOptions'));
    }
}
