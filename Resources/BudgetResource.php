<?php

namespace App\Http\Resources\Budget;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="BudgetResource",
 *     type="object",
 *     title="Budget Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="category_id", type="integer", example=1),
 *     @OA\Property(property="amount", type="number", format="float", example=500.00),
 *     @OA\Property(property="start_date", type="string", format="date", example="2024-01-01"),
 *     @OA\Property(property="end_date", type="string", format="date", example="2024-01-31"),
 *     @OA\Property(property="category", ref="#/components/schemas/CategoryResource"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class BudgetResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'amount' => (float) $this->amount,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}