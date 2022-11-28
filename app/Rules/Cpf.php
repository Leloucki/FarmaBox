<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class Cpf implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $c = empty($value) ? "" : preg_replace('/[^\d]/', '', $value);
        $message = "CPF inválido";
        //dd($c);

        if (mb_strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            $fail($message);
        }

        for (
            $s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--
        ) {
        }

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            $fail($message);
        }

        for (
            $s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--
        ) {
        }

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            $fail($message);
        }
    }
}
