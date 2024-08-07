<?php

namespace App\Rules;

use App\Models\Account;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SufficientFunds implements ValidationRule
{
    protected float $amount;
    protected int $senderId;

    public function __construct(float $amount, int $senderId) {
        $this->amount = $amount;
        $this->senderId = $senderId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $sender = Account::find($this->senderId);

        if($sender->balance < $this->amount * 100) {
            $fail('Insufficient funds for transfer.');
        }
    }
}
