<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Base Request Class
 * 
 * This abstract class serves as the foundation for all form request classes
 * in the application. It extends Laravel's FormRequest to provide common
 * functionality and structure for request validation.
 * 
 * @package App\Http\Requests
 * @version 1.0.0
 */
abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool Returns true if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function listRules(): array
    {
        return [
            'page' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'per_page' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'sort_by' => [
                'nullable',
                'string',
                'in:created_at',
            ],
            'sort_order' => [
                'nullable',
                'string',
                'in:asc,desc',
            ],
        ];
    }
}