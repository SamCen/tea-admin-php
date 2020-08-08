<?php

namespace App\Http\Requests\App\Auth;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class BindUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code'=>'required|string',
            'phone'=>['required',new Phone()],
        ];
    }
}
