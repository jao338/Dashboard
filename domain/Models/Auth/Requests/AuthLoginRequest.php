<?php

namespace Domain\Models\Auth\Requests;

use Domain\Base\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string',  'min:8', new PasswordRule($this->input('password'))],
        ];
    }
}
