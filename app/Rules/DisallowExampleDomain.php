<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class DisallowExampleDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value)) {
            return;
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL) && Str::endsWith(strtolower($value), '@example.com')) {
            $fail('Logins from the example.com domain are not permitted.');
        }
    }
}
