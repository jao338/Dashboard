<?php

namespace Domain\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule {

    public function __construct(protected ?string $password = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $password = (string) $value;

        if (strlen($password) < 8) {
            $fail('A senha deve conter pelo menos 8 caracteres.');
            return;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            $fail('A senha deve conter pelo menos uma letra maiúscula.');
            return;
        }

        if (!preg_match('/[0-9]/', $password)) {
            $fail('A senha deve conter pelo menos um número.');
            return;
        }

        if (!preg_match('/[\W_]/', $password)) { // caracteres especiais
            $fail('A senha deve conter pelo menos um caractere especial.');
            return;
        }
    }

}
