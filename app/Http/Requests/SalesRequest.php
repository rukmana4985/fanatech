<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class SalesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'number'  =>  'required|numeric',
            'date'    =>  'required',
            'user_id' =>  'required',
        ];
    }

}
