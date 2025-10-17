<?php

namespace App\Http\Resources\Common;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * Timezone Resource
 * 
 * This resource class handles the transformation of timezone data
 * into a consistent JSON structure for API responses. It provides
 * timezone information with proper formatting for frontend consumption.
 * 
 * @package App\Http\Resources\Common
 * @version 1.0.0
 * 
 * @OA\Schema(
 *     schema="TimezoneResource",
 *     type="object",
 *     title="Timezone Resource",
 *     description="Timezone data structure",
 *     @OA\Property(property="value", type="string", example="Atlantic/Cape_Verde", description="Timezone identifier"),
 *     @OA\Property(property="name", type="string", example="(GMT-01:00) Atlantic/Cape_Verde", description="Formatted timezone display name with GMT offset")
 * )
 */
class TimezoneResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     * 
     * This method converts the timezone data into a structured array
     * suitable for JSON API responses. It includes the timezone identifier
     * and formatted display name with GMT offset information.
     * 
     * @param Request $request The incoming HTTP request instance
     * @return array<string, mixed> The transformed timezone data array
     */
    public function toArray(Request $request): array
    {
        return [
            'value' => $this->resource['value'],
            'name' => $this->resource['name'],
        ];
    }
}
