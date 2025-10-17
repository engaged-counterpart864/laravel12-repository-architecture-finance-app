<?php

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * User Resource
 *
 * This resource class handles the transformation of User model data
 * into a consistent JSON structure for API responses. It includes
 * user profile information, associated customer data when available,
 * and a collection of user settings.
 *
 * @package App\Http\Resources
 * @version 1.0.0
 *
 * @OA\Schema(
 *     schema="UserResource",
 *     type="object",
 *     title="User Resource",
 *     description="User profile data structure",
 *     @OA\Property(property="id", type="integer", example=1, description="Unique user identifier"),
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com", description="User email address"),
 *     @OA\Property(
 *         property="customer",
 *         ref="#/components/schemas/CustomerResource",
 *         nullable=true,
 *         description="Associated customer information"
 *     ),
 * )
 */
class UserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * This method converts the User model instance into a structured array
     * suitable for JSON API responses. It includes user identification data
     * and conditionally includes customer information if available.
     *
     * @param Request $request The incoming HTTP request instance
     * @return array<string, mixed> The transformed user data array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}