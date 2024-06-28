<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Schema;

class CheckTableColumn implements ValidationRule
{
    public function __construct(private string $tableName)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( ! Schema::connection(config('database.default'))->hasColumn($this->tableName, $value)) {
            $fail("Column $value does not exist in $this->tableName table.");
        }
    }
}
