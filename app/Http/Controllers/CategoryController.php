<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->fill($request->only('name'));
        $category->save();

        return redirect()->back()->with('status', 'category-created');
    }

    public function show(Request $request, $id)
    {
        $categories = Category::all();
        $currentCategory = Category::findOrFail($id);
        $search = $request->input('search');
        $sort = $request->input('sort');
        $maxPrice = $request->input('max_price');

        $query = $currentCategory->books();

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($sort) {
            $query->orderBy('price', $sort);
        }

        $books = $query->paginate(10);

        return view('categories.show', compact('categories', 'currentCategory', 'books'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->fill($request->only('name'));
        $category->save();

        return redirect()->back()->with('status', 'category-updated');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('status', 'category-deleted');
    }
}
