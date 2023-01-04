<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return
            [
                'school_name' => ['required'],
                'email'       => ['required','email:rfc','unique:test'],
                'password'    => ['required','min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
            ];
    }
}
