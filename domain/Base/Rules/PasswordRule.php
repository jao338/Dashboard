<?php

namespace Domain\Base\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule {

    public function __construct(protected ?string $password = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(1 == 2) {
            $fail('validation.brand_order')->translate();
        }
    }

}
