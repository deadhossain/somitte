<?php

namespace App\Http\Requests\backends\savings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreSavingsDepositRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        // 'savings_accounts_id'=> 'required',
        'deposit_amount' => 'numeric|required',
        'late_fee' => 'numeric|nullable',
        'schedule_date' => ['required','date'],
        'deposit_date' => ['required','date','after_or_equal:start_date']
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
            // 'savings_accounts_id' => 'Savings Account',
            'deposit_amount' => 'Deposit amount',
            'late_fee' => 'Late Fee',
            'schedule_date' => 'Schedule Date',
            'deposit_date' => 'Deposit Date'
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
