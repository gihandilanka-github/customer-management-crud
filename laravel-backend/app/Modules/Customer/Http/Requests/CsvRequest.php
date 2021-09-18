<?php

namespace App\Modules\Customer\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CsvRequest extends FormRequest
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
            'csvFile' => ['required'],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'csvFile.required' => 'CSV file is required.'
        ];
    }

}
