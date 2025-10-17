<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreTransactionRequest",
 *     type="object",
 *     required={"account_id", "type", "amount", "date"},
 *     @OA\Property(property="account_id", type="integer", example=1),
 *     @OA\Property(property="type", type="string", enum={"debit", "credit"}, example="debit"),
 *     @OA\Property(property="amount", type="number", format="float", example=100.50),
 *     @OA\Property(property="date", type="string", format="date-time", example="2024-01-15T10:30:00Z"),
 *     @OA\Property(property="description", type="string", example="Grocery shopping"),
 *     @OA\Property(property="category_id", type="integer", example=1)
 * )
 */
class StoreTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id' => ['required', 'integer', 'exists:accounts,id'],
            'type' => ['required', 'in:debit,credit'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
        ];
    }
}