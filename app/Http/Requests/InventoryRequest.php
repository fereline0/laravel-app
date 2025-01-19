<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'device_id' => 'required|exists:devices,id',
            'quantity' => 'required|integer|min:1',
            'cabinet_id' => 'required|exists:cabinets,id',
        ];
    }
}
