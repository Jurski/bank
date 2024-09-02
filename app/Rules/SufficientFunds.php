<?php

namespace App\Rules;

use App\Models\Account;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SufficientFunds implements ValidationRule
{
    protected float $amount;
    protected int $accountId;

    public function __construct(float $amount, int $accountId)
    {
        $this->amount = $amount;
        $this->accountId = $accountId;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $account = Account::find($this->accountId);

        if ($account->balance < $this->amount * 100) {
            $fail('Insufficient funds for operation.');
        }
    }
}
