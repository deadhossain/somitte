<?php

namespace App\Http\Requests\backends\loan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreLoanSchemeRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        'name' => 'required|max:50|unique:loan_schemes',
        'min_amount' => 'required|numeric|min:0|max:999999999999|lte:max_amount',
        'max_amount' => 'required|numeric|min:0|max:999999999999|gte:min_amount',
        'late_fee' => 'required|numeric|min:0|max:999999999999',
        'max_installment' => 'required|numeric|min:1|max:999999999999',
        'rate' => 'required|numeric|min:0|max:999999999999'
    ];
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
        $rules = $this::VALIDATION_RULES;
        if ($this->getMethod() == 'POST') {

        }else if ($this->getMethod() == 'PATCH'){
            $rules['name'] = 'required|unique:loan_schemes,name,'.Crypt::decrypt($this->scheme);
        }
        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Name',
            'min_amount' => 'Min Amount',
            'max_amount' => 'Max Amount',
            'late_fee' => 'Late Fee',
            'rate' => 'Rate',
            'remarks' => 'Remarks',
            'max_installment' => 'Max Installment'
        ];


    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
