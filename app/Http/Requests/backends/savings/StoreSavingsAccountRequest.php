<?php

namespace App\Http\Requests\backends\savings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreSavingsAccountRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        'account_no' => 'required|max:50|unique:savings_accounts',
        'customer_id'=> 'required',
        'savings_scheme_id'=> 'required',
        'deposit_amount' => 'required|numeric|min:1|max:999999999999',
        'late_fee' => 'required|numeric|min:0|max:999999999999',
        'profit' => 'required|numeric|min:0|max:999999999999',
        'first_deposit_amount' => 'numeric|nullable',
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
            $rules['account_no'] = 'required|unique:savings_accounts,account_no,'.Crypt::decrypt($this->account);
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
            'customer_id'=> 'Customer',
            'savings_scheme_id'=> 'Savings Scheme',
            'savings_amount' => 'Savings Amount',
            'late_fee' => 'Late Fee',
            'profit' => 'Profit',
            'account_no' => 'Account No',
            'first_deposit_amount' => 'Amount',
            'start_date' => 'Start Date',
            'end_date' => 'End Date'
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
