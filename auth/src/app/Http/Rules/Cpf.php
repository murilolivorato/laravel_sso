<?php

namespace App\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/[^0-9]/', "", $value);
        if (strlen($cpf) != 11 || preg_match('/([0-9])\1{10}/', $cpf)) {
            $fail('validation.cpf.invalid')->translate();
            return;
        }

        for ($position = 10, $sum = 0, $index = 0; $position >= 2; $sum += $cpf[$index++] * $position--);
        if ($cpf[9] != ((($sum %= 11) < 2) ? 0 : 11 - $sum)) {
            $fail('validation.cpf.invalid')->translate();
            return;
        }

        for ($position = 11, $sum = 0, $index = 0; $position >= 2; $sum += $cpf[$index++] * $position--);
        if ($cpf[10] != ((($sum %= 11) < 2) ? 0 : 11 - $sum)) {
            $fail('validation.cpf.invalid')->translate();
        }
    }
}
