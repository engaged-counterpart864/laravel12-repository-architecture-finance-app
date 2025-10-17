<?php

namespace App\Http\Resources\Transaction;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Account\AccountResource;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="TransactionResource",
 *     type="object",
 *     title="Transaction Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="account_id", type="integer", example=1),
 *     @OA\Property(property="type", type="string", enum={"debit", "credit"}, example="debit"),
 *     @OA\Property(property="amount", type="number", format="float", example=100.50),
 *     @OA\Property(property="date", type="string", format="date-time"),
 *     @OA\Property(property="description", type="string", example="Grocery shopping"),
 *     @OA\Property(property="category_id", type="integer", example=1),
 *     @OA\Property(property="account", ref="#/components/schemas/AccountResource"),
 *     @OA\Property(property="category", ref="#/components/schemas/CategoryResource"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class TransactionResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'type' => $this->type,
            'amount' => (float) $this->amount,
            'date' => $this->date,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'account' => AccountResource::make($this->whenLoaded('account')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}