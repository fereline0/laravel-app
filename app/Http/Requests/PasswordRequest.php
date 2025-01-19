<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'source' => 'required|string|max:255',
            'value' => 'required|string',
            'privacy' => 'boolean',
        ];
    }
}
