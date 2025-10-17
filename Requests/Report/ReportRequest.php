<?php

namespace App\Http\Requests\Report;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ReportRequest",
 *     type="object",
 *     required={"from", "to"},
 *     @OA\Property(property="from", type="string", format="date", example="2024-01-01"),
 *     @OA\Property(property="to", type="string", format="date", example="2024-12-31")
 * )
 */
class ReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'from' => ['required', 'date'],
            'to' => ['required', 'date', 'after_or_equal:from'],
        ];
    }
}