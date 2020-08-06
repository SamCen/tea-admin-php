<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleIndexRequest extends FormRequest
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
            'page'=>'integer',
            'size'=>'integer',
        ];
    }

    public function messages()
    {
        return [
            'page.integer'=>'页码只能为整数',
            'size.integer'=>'每页数量只能为整数',
        ];
    }
}
