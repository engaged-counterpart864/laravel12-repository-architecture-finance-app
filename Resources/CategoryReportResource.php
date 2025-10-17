<?php

namespace App\Http\Resources\Report;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="CategoryReportResource",
 *     type="object",
 *     title="Category Report Resource",
 *     @OA\Property(property="category_id", type="integer", example=1),
 *     @OA\Property(property="category_name", type="string", example="Food"),
 *     @OA\Property(property="income", type="number", format="float", example=0.00),
 *     @OA\Property(property="expense", type="number", format="float", example=500.00),
 *     @OA\Property(property="net", type="number", format="float", example=-500.00)
 * )
 */
class CategoryReportResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'category_id' => $this->resource['category_id'],
            'category_name' => $this->resource['category_name'],
            'income' => $this->resource['income'],
            'expense' => $this->resource['expense'],
            'net' => $this->resource['net'],
        ];
    }
}