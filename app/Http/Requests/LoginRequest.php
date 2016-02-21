<?php

namespace Convert\Http\Requests;

use Convert\Http\Requests\Request;

class LoginRequest extends Request
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
        return [
            'username' => 'required|min:5|max:15',
            'password' => 'required',
            //'g-recaptcha-response' => 'required|captcha'
        ];
    }
}
