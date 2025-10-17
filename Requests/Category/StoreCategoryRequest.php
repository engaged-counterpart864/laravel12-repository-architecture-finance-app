<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreCategoryRequest",
 *     type="object",
 *     required={"name", "type"},
 *     @OA\Property(property="name", type="string", maxLength=255, example="Food"),
 *     @OA\Property(property="type", type="string", enum={"expense", "income"}, example="expense")
 * )
 */
class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:expense,income'],
        ];
    }
}