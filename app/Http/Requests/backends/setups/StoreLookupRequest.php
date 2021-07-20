<?php

namespace App\Http\Requests\backends\setups;

use Illuminate\Foundation\Http\FormRequest;

class StoreLookupRequest extends FormRequest
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
        $rules = $this::VALIDATION_RULES;

        if ($this->getMethod() == 'POST') {

        }else if ($this->getMethod() == 'PUT'){
            $rules['name'] = 'required|unique:lookups,name,'.$this->lookup->id;
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
