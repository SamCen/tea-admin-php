<?php

namespace App\Http\Requests\App\Operation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OperationRecordStoreRequest extends FormRequest
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
            'product_id' => 'required|integer|min:1',
            'action' => ['required', Rule::in('input', 'output')],
            'num' => 'required|integer|min:1',
        ];
    }
}
