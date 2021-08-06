<?php

namespace App\Http\Requests\backends\setups;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLookupDetailRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        'name' => 'required|unique:lookups',
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
        if ($this->getMethod() == 'POST') {
            $rules = [
                'name' => ['required',
                    Rule::unique('lookup_details')->where(function ($query){
                        return $query->where('active_fg', 1)->where('lookup_id', $this->lookup_id);
                    }),
                ],
            ];
        }else if ($this->getMethod() == 'PATCH'){
            $rules = [
                'name' => ['required',
                    Rule::unique('lookup_details')->where(function ($query){
                        return $query->where('active_fg', 1)->where('lookup_id', $this->lookup_detail->lookup_id)->where('id','<>', $this->lookup_detail->id);
                    }),
                ],
            ];
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
