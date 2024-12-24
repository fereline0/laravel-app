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
    public function users(): View
    {
        $users = User::paginate(20);
        $registeredTodayCount = User::whereDate('created_at', today())->count();
        $totalUsersCount = User::count();

        return view('admin.users', compact('users', 'registeredTodayCount', 'totalUsersCount'));
    }

    public function categories(): View
    {
        $categories = Category::paginate(20);
        return view('admin.categories', compact('categories'));
    }

    public function publishers(): View
    {
        $publishers = Publisher::paginate(20);
        return view('admin.publishers', compact('publishers'));
    }

    public function authors(): View
    {
        $authors = Author::paginate(20);
        return view('admin.authors', compact('authors'));
    }

    public function books(): View
    {
        $books = Book::paginate(20);
        return view('admin.books', compact('books'));
    }
}
