<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;

class BookController extends Controller
{
    public function show(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('books.edit', compact('book', 'authors', 'publishers', 'categories'));
    }

    public function update(BookCreateRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->price = $request->price;

        if ($request->hasFile('image')) {
            $book->image = $request->file('image')->store('books', 'public');
        }

        $book->save();
        $book->categories()->sync($request->categories);

        return redirect()->route('books.show', $book->id)->with('status', 'book-updated');
    }

    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('books.create', compact('authors', 'publishers', 'categories'));
    }

    public function store(BookCreateRequest $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->price = $request->price;

        if ($request->hasFile('image')) {
            $book->image = $request->file('image')->store('books', 'public');
        }

        $book->save();

        $book->categories()->attach($request->categories);

        return redirect()->route('books.create')->with('status', 'book-created');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->back()->with('status', 'book-deleted');
    }
}