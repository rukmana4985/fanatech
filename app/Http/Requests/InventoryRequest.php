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
            'code'  =>  'required|numeric',
            'name'  =>  'required',
            'price' =>  'required|numeric',
            'stock' =>  'required|numeric'
        ];
    }

}
