<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateCategoryRequest",
 *     type="object",
 *     @OA\Property(property="name", type="string", maxLength=255, example="Food"),
 *     @OA\Property(property="type", type="string", enum={"expense", "income"}, example="expense")
 * )
 */
class UpdateCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'in:expense,income'],
        ];
    }
}