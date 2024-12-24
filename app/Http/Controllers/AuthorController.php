<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::paginate(10);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function show(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $books = $author->books()->paginate(20);

        return view('authors.show', compact('author', 'books'));
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function store(AuthorRequest $request)
    {
        $author = new Author();
        $author->fill($request->only('name', 'description'));

        if ($request->hasFile('image')) {
            $author->image = $request->file('image')->store('authors', 'public');
        }

        $author->save();

        return redirect()->back()->with('status', 'author-created');
    }

    public function update(AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->fill($request->only('name', 'description'));

        if ($request->hasFile('image')) {
            if ($author->image) {
                Storage::disk('public')->delete($author->image);
            }
            $author->image = $request->file('image')->store('authors', 'public');
        }

        $author->save();

        return redirect()->back()->with('status', 'author-updated');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        if ($author->image) {
            Storage::disk('public')->delete($author->image);
        }
        $author->delete();

        return redirect()->back()->with('status', 'author-deleted');
    }
}
