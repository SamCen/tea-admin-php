<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'category_id'=>'required|integer|min:1',
            'product_unit'=>'required|string',
            'product_name'=>'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'category_id'=>'分类',
            'product_unit'=>'单位',
            'product_name'=>'产品名称'
        ];
    }
}
