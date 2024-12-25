<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');
        $sort = $request->input('sort');
        $maxPrice = $request->input('max_price');

        $query = Book::query();

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($sort) {
            $query->orderBy('price', $sort);
        }

        $books = $query->paginate(20);

        return view('home', compact('categories', 'books'));
    }
}