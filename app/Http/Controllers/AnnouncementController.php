<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\AnnouncementRequest;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
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

        return view('announcements.index', compact('announcements', 'sortOptions'));
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('announcements.show', compact('announcement'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(AnnouncementRequest $request)
    {
        Announcement::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'value' => $request->value,
        ]);

        return redirect()->route('dashboard.announcements.index');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('announcements.edit', compact('announcement'));
    }

    public function update(AnnouncementRequest $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        $announcement->update([
            'title' => $request->title,
            'value' => $request->value,
        ]);

        return redirect()->route('dashboard.announcements.index');
    }

    public function destroy($id)
    {
        $password = Announcement::findOrFail($id);
        $password->delete();

        return redirect()->route('dashboard.announcements.index');
    }
}
