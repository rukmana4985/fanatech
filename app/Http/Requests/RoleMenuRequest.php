<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class RoleMenuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'role_id' => 'required',
            'menu_id' => 'required',
        ];
    }

}
