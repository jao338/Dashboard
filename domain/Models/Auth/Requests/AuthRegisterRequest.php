<?php

namespace Domain\Models\Auth\Requests;

use Domain\Base\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
//                new PasswordRule($this->input('password'), $this->input('confirm_password')),
            ],
            'confirm_password' => [
                'required',
                'string',
                'min:8',
            ],
            'access_type' => [
                'nullable',
                'integer',
                'in:1,2', // 1 = User, 2 = Admin
            ],
            'telephony' => [
                'integer',
                //  Criar regra para telefone celular, se precisar
            ],
        ];
    }
}
