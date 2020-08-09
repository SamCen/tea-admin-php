<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            'username'=>'bail|required|string|unique:users',
            'password'=>'required|string',
            'phone'=>['bail','required',new Phone(),'unique:users'],
            'role'=>['required','integer',Rule::in(1,2)],
        ];
    }
}
