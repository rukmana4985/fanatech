<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class PurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'number'  =>  'required',
            'date'  =>  'required',
            'user_id'   => 'required'

        ];
    }

}
