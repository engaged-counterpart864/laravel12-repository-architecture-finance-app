<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="IndexTransactionRequest",
 *     type="object",
 *     @OA\Property(property="account_id", type="integer", example=1),
 *     @OA\Property(property="category_id", type="integer", example=1),
 *     @OA\Property(property="type", type="string", enum={"debit", "credit"}, example="debit"),
 *     @OA\Property(property="date_from", type="string", format="date", example="2024-01-01"),
 *     @OA\Property(property="date_to", type="string", format="date", example="2024-12-31"),
 *     @OA\Property(property="per_page", type="integer", example=10)
 * )
 */
class IndexTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'account_id' => ['sometimes', 'integer', 'exists:accounts,id'],
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'type' => ['sometimes', 'in:debit,credit'],
            'date_from' => ['sometimes', 'date'],
            'date_to' => ['sometimes', 'date', 'after_or_equal:date_from'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }
}