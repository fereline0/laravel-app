<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
{
    return [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'author_id' => 'required|exists:authors,id',
        'publisher_id' => 'required|exists:publishers,id',
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
}
}
