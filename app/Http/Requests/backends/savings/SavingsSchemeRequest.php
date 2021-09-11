<?php

namespace App\Http\Requests\backends\savings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class SavingsSchemeRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        'name' => 'required|max:50|unique:savings_schemes',
        'amount' => 'required|numeric|min:0|max:999999999999',
        'late_fee' => 'required|numeric|min:0|max:999999999999',
        'profit' => 'required|numeric|min:0|max:999999999999',
        'start_date' => ['required','date'],
        'end_date' => ['nullable','date','after:start_date']
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
            $rules['name'] = 'required|unique:users,name,'.Crypt::decrypt($this->scheme);
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
            'amount' => 'Amount',
            'late_fee' => 'Late Fee',
            'profit' => 'Profit',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'remarks' => 'Remarks'
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
