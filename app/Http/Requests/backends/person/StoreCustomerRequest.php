<?php

namespace App\Http\Requests\backends\person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreCustomerRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        'name' => 'required|max:50',
        'customer_uid' => 'required|max:50|unique:customers',
        'nid_no' => 'required|max:50|unique:customers',
        'gender_id' => 'required',
        'phone' => 'required',
        'start_date' => ['required','date'],
        'end_date' => ['nullable','date','after:start_date'],
        'image' => 'mimes:jpeg,jpg,bmp,png|max:5000',
        'nid_attachment' => 'mimes:jpeg,jpg,bmp,png,pdf|max:5000',
    ];

    protected $fillable = [
        'name','customer_uid','nid_no','gender_id','phone','start_date','end_date','image','nid_attachment','address','remarks','active_fg'
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
            $id=Crypt::decrypt($this->customer);
            $rules['customer_uid'] = 'required|unique:customers,customer_uid,'.$id;
            $rules['nid_no'] = 'required|unique:customers,nid_no,'.$id;
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
            'customer_uid' => 'Customer Id',
            'nid_no' => 'NID No.',
            'gender_id' => 'Gender',
            'phone' => 'Phone ',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'image' => 'image',
            'nid_attachment' => 'nid',
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
