<?php

namespace App\Http\Requests;

use App\Rules\SufficientFunds;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sender' => 'required',
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                new SufficientFunds($this->input('amount'), $this->input('sender'))
            ],
            'receiver' => ['required', 'uuid', 'exists:accounts,account_number'],
        ];
    }

}
