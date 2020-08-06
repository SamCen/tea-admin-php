<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class AdminIndexRequest extends FormRequest
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
            'page'=>'nullable|integer',
            'size'=>'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'page.required' => '缺少页码',
            'size.required' => '缺少每页数量',
            'page.integer' => '页码只能为整数',
            'size.integer' => '每页数量只能为整数',
        ];
    }
}
