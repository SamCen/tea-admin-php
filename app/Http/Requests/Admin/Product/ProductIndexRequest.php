<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
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
            'page'=>'nullable|integer|min:1',
            'limit'=>'nullable|integer|min:1'
        ];
    }

    public function attributes()
    {
        return [
            'page'=>'页码',
            'limit'=>'每页数量'
        ];
    }
}
