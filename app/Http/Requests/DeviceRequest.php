<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'serial_number' => 'required|string|max:255',
            'purchase_date' => 'required|date',
            'price' => 'required|numeric',
        ];
    }
}
