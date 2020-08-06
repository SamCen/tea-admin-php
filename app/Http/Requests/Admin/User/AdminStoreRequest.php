<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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
            'account'=>'required',
            'password'=>'required',
            'name'=>'required',
            'status'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'account.required'=>'缺少账号',
            'password.required'=>'缺少密码',
            'name.required'=>'缺少名称',
            'status.required'=>'缺少状态',
        ];
    }
}
