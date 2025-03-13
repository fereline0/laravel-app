<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(HttpRequest $request)
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

        $requestQuery = Request::where('user_id', Auth::id());

        if ($request->filled('request_sort')) {
            $requestSort = $request->input('request_sort');
            $requestQuery->orderBy('created_at', $requestSort);
        } else {
            $requestQuery->orderBy('created_at', 'desc');
        }

        $requests = $requestQuery->paginate(20);

        return view('index', compact('announcements', 'sortOptions', 'requests'));
    }
}