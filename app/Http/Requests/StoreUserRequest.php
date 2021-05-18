<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    private const VALIDATION_RULES = [
        'name' => 'required|unique:users|max:20',
        'email' => 'required|email',
        'password' => 'required|min:6',
        'confirm_password' => 'required_with:password|same:password'
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
}
