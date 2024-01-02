<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class PurchaseDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'purchase_id'   =>  'required',
            'inventory_id'  =>  'required',
            'qty'           =>  'required|numeric',
            'price'         =>  'required|numeric'

        ];
    }

}
