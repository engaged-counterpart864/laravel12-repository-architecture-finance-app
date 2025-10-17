<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="CategoryResource",
 *     type="object",
 *     title="Category Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Food"),
 *     @OA\Property(property="type", type="string", enum={"expense","income"}, example="expense"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class CategoryResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}