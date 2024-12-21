<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function show(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $books = $author->books()->paginate(20);

        return view('authors.show', compact('author', 'books'));
    }
}
