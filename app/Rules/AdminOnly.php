<?php

namespace App\Rules;

use App\Enums\RolesEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class AdminOnly implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Auth::user()->role->name !== RolesEnum::ADMIN->value && $value != null) {
            $fail('only admins can update :attribute.');
        }
    }
}
