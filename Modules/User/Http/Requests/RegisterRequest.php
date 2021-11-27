<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Entities\User;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'recaptcha'   => 'required|recaptcha',
            'name'        => 'required|string|max:100',
            'email'       => 'required|email|max:255',
            'password'    => 'required|string|max:255',
            'is_employer' => 'nullable|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !User::current();
    }
}
