<?php

namespace App\Modules\Customer\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
{
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
        $rules = [
            'customer_firstname' => ['required'],
            'customer_lastname' => ['required'],
            'customer_email' => [
                'required', 'email',
                Rule::unique('customers')->ignore($this->route('customer'), 'id')->whereNull('deleted_at')
            ],
            'customer_phone' => ['nullable', new PhoneNumber(), 'max:50'],
        ];

        return $rules;
    }

    public function messages()
    {
        return [];
    }

}
