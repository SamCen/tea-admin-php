<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'password'=>'nullable|string',
            'phone'=>['bail','nullable',new Phone(),],
            'role'=>['nullable','integer',Rule::in(1,2)],
        ];
    }

    public function attributes()
    {
        return [
//            'username'=>'用户账号',
            'password'=>'密码',
            'phone'=>'手机号码',
            'role'=>'角色',
        ];
    }
}
