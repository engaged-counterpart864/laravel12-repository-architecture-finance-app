<?php

namespace App\Http\Resources\Report;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="SummaryReportResource",
 *     type="object",
 *     title="Summary Report Resource",
 *     @OA\Property(property="income", type="number", format="float", example=5000.00),
 *     @OA\Property(property="expense", type="number", format="float", example=3000.00),
 *     @OA\Property(property="net", type="number", format="float", example=2000.00)
 * )
 */
class SummaryReportResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'income' => $this->resource['income'],
            'expense' => $this->resource['expense'],
            'net' => $this->resource['net'],
        ];
    }
}