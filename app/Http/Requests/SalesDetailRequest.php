<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class SalesDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'sales_id'      =>  'required',
            'inventory_id'  =>  'required',
            'price'         =>  'required|numeric',
            'qty'           =>  'required|numeric'
        ];
    }

}
