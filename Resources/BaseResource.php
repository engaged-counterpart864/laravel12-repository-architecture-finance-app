<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Base Resource Class
 * 
 * This abstract class serves as the foundation for all API resource classes
 * in the application. It extends Laravel's JsonResource to provide common
 * functionality and structure for API response formatting.
 * 
 * @package App\Http\Resources
 * @version 1.0.0
 */
abstract class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * 
     * This method provides a default implementation that delegates to the
     * parent JsonResource's toArray method. Child classes can override
     * this method to provide custom transformation logic.
     *
     * @param Request $request The incoming HTTP request instance
     * @return array<string, mixed> The transformed resource data array
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
