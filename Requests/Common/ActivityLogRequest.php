<?php

namespace App\Http\Requests\Common;

use App\Http\Requests\BaseRequest;

/**
 * Activity Log Request
 * 
 * Handles validation for activity log requests.
 * 
 * @package App\Http\Requests\Common
 * @version 1.0.0
 * 
 * @OA\Schema(
 *     schema="ActivityLogRequest",
 *     type="object",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/BaseListRequest"),
 *         @OA\Schema(
 *             @OA\Property(property="category", type="string", nullable=true, description="Activity category"),
 *             @OA\Property(property="sub_category", type="string", nullable=true, description="Activity sub-category"),
 *             @OA\Property(property="affected_id", type="integer", nullable=true, description="ID of the affected entity"),
 *             @OA\Property(property="event_id", type="integer", nullable=true, description="Event identifier"),
 *             @OA\Property(property="user_email", type="string", format="email", nullable=true, description="User email or identifier"),
 *             @OA\Property(property="platform", type="string", nullable=true, description="Platform where the activity occurred"),
 *             @OA\Property(property="url", type="string", nullable=true, description="URL accessed"),
 *             @OA\Property(property="method", type="string", nullable=true, description="HTTP method used"),
 *             @OA\Property(property="ip", type="string", nullable=true, description="IP address of the user"),
 *             @OA\Property(property="start_date", type="string", format="date", nullable=true, description="Start date for filtering logs"),
 *             @OA\Property(property="end_date", type="string", format="date", nullable=true, description="End date for filtering logs"),
 *         )
 *     }
 * )
 */
class ActivityLogRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::listRules(), [
            'category' => [
                'nullable',
                'string',
            ],
            'sub_category' => [
                'nullable',
                'string',
            ],
            'affected_id' => [
                'nullable',
                'integer',
            ],
            'event_id' => [
                'nullable',
                'integer',
            ],
            'user_email' => [
                'nullable',
                'email',
            ],
            'platform' => [
                'nullable',
                'string',
            ],
            'url' => [
                'nullable',
                'string',
            ],
            'method' => [
                'nullable',
                'string',
            ],
            'start_date' => [
                'nullable',
                'date',
            ],
            'end_date' => [
                'nullable',
                'date',
            ]

        ]);
    }
}
