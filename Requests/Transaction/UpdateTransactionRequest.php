<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateTransactionRequest",
 *     type="object",
 *     @OA\Property(property="account_id", type="integer", example=1),
 *     @OA\Property(property="type", type="string", enum={"debit", "credit"}, example="debit"),
 *     @OA\Property(property="amount", type="number", format="float", example=100.50),
 *     @OA\Property(property="date", type="string", format="date-time", example="2024-01-15T10:30:00Z"),
 *     @OA\Property(property="description", type="string", example="Grocery shopping"),
 *     @OA\Property(property="category_id", type="integer", example=1)
 * )
 */
class UpdateTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id' => ['sometimes', 'integer', 'exists:accounts,id'],
            'type' => ['sometimes', 'in:debit,credit'],
            'amount' => ['sometimes', 'numeric', 'min:0.01'],
            'date' => ['sometimes', 'date'],
            'description' => ['nullable', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
        ];
    }
}