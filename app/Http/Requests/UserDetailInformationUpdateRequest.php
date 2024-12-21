<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailInformationUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'about' => 'nullable|string',
            'gender' => 'nullable|in:male,female,none',
            'birthday' => 'nullable|date',
            'phone_number' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ];
    }
}
