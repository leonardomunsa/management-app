<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CNPJ implements ValidationRule
{
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not a valid CNPJ.';
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cnpj = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cnpj) != 14) {
            $fail($this->message());
            return;
        }

        if (preg_match('/^(\d)\1*$/', $cnpj)) {
            $fail($this->message());
            return;
        }

        for ($t = 12; $t < 14; $t++) {
            $d = 0;
            $c = 0;
            $multipliers = ($t === 12) ? [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2] : [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

            foreach ($multipliers as $i => $multiplier) {
                $d += $cnpj[$i] * $multiplier;
            }

            $d = ($d % 11) < 2 ? 0 : 11 - ($d % 11);

            if ($cnpj[$t] != $d) {
                $fail($this->message());
                return;
            }
        }

    }
}
