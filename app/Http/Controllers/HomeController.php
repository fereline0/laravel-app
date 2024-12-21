<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::paginate(20);

        return view('home', compact('books'));
    }
}
