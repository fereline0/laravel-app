<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublisherRequest;
use App\Models\Publisher;

class PublisherController extends Controller
{
    public function create()
    {
        return view('publishers.create');
    }

    public function store(PublisherRequest $request)
    {
        $publisher = new Publisher();
        $publisher->fill($request->only('name'));
        $publisher->save();

        return redirect()->back()->with('status', 'publisher-created');
    }

    public function show($id)
    {
        $publishers = Publisher::all();
        $currentPublisher = Publisher::findOrFail($id);
        $books = $currentPublisher->books()->paginate(10);

        return view('publishers.show', compact('publishers', 'currentPublisher', 'books'));
    }

    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('publishers.edit', compact('publisher'));
    }

    public function update(PublisherRequest $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        $publisher->fill($request->only('name'));
        $publisher->save();

        return redirect()->back()->with('status', 'publisher-updated');
    }

    public function destroy($id)
    {
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        return redirect()->back()->with('status', 'publisher-deleted');
    }
}
