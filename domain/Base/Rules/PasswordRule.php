<?php

namespace Domain\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule {

    public function __construct(protected ?string $password = null, protected ?string $confirm_password = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //  Refatorar depois, criar validação correta
        if(1 == 2) {
            $fail('validation.brand_order')->translate();
        }
    }

}
