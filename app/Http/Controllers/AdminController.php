<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function users(Request $request): View
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(20);
        $registeredTodayCount = User::whereDate('created_at', today())->count();
        $totalUsersCount = User::count();

        return view('admin.users', compact('users', 'registeredTodayCount', 'totalUsersCount'));
    }

    public function categories(Request $request): View
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $categories = $query->paginate(20);

        return view('admin.categories', compact('categories'));
    }

    public function publishers(Request $request): View
    {
        $query = Publisher::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $publishers = $query->paginate(20);

        return view('admin.publishers', compact('publishers'));
    }

    public function authors(Request $request): View
    {
        $query = Author::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $authors = $query->paginate(20);

        return view('admin.authors', compact('authors'));
    }

    public function books(Request $request): View
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $books = $query->paginate(20);

        return view('admin.books', compact('books'));
    }
}
