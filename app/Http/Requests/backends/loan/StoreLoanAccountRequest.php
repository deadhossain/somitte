<?php

namespace App\Http\Requests\backends\loan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreLoanAccountRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        'account_no' => 'required|max:50|unique:loan_accounts',
        'loan_amount' => 'required|numeric|min:1|max:999999999999|lte:total_payable_amount',
        'total_payable_amount' => 'required|numeric|min:1|max:999999999999|gte:loan_amount',
        'late_fee' => 'required|numeric|min:0|max:999999999999',
        'total_installment_no' => 'required|numeric|min:1|max:999999999999',
        'rate' => 'required|numeric|min:0|max:999999999999',
        'customer_id'=> 'required',
        'nominee_id'=> 'required',
        'loan_scheme_id'=> 'required',
        'account_status'=> 'required',
        'loan_date' => ['required','date'],
        'start_installment_date' => ['required','date','after:loan_date'],
        'end_installment_date' => ['nullable','date','after:start_installment_date']
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
            // dd($rules);
        }else if ($this->getMethod() == 'PATCH'){
            $rules['account_no'] = 'required|unique:loan_accounts,account_no,'.Crypt::decrypt($this->account);
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
            'account_no' => 'Account No',
            'loan_amount' => 'Loan Amount',
            'total_payable_amount' => 'Total Payable Amount',
            'late_fee' => 'Late Fee',
            'total_installment_no' => 'Total Installment No',
            'rate' => 'Rate',
            'customer_id'=> 'Customer',
            'nominee_id'=> 'Nominee',
            'loan_scheme_id'=> 'Loan Scheme',
            'account_status'=> 'Account Status',
            'loan_date' => 'Loan Date',
            'start_installment_date' => 'Start Installment Date',
            'end_installment_date' => 'End Installment Date'
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
