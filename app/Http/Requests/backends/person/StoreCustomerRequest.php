<?php

namespace App\Http\Requests\backends\person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreCustomerRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        'name' => 'required|max:50|unique:customers',
        'nid_no' => 'required|max:50|unique:customers',
        'gender_id' => 'required',
        'phone' => 'required',
        'start_date' => ['required','date'],
        'end_date' => ['nullable','date','after:start_date'],
    ];

    protected $fillable = [
        'name','nid_no','gender_id','phone','start_date','end_date','image','nid_attachment','address','remarks','active_fg'
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
        dd("asdasd");
        $rules = $this::VALIDATION_RULES;
        if ($this->getMethod() == 'POST') {

        }else if ($this->getMethod() == 'PATCH'){
            $rules['name'] = 'required|unique:customers,name,'.Crypt::decrypt($this->customer);
            $rules['nid_no'] = 'required|unique:customers,nid_no,'.Crypt::decrypt($this->customer);
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
            'nid_no' => 'NID No.',
            'gender_id' => 'Gender',
            'phone' => 'Phone ',
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
