<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

/**
 * Update User Image Request
 * 
 * This request class handles validation for user profile image updates.
 * It validates the image URL and ensures it's a valid S3 URL format.
 * 
 * @package App\Http\Requests\User
 * @version 1.0.0
 * 
 * @OA\Schema(
 *     schema="UpsertUserRequest",
 *     type="object",
 *     title="Update User Image Request",
 *     description="Request payload for updating user profile image",
 *     required={"image"},
 *     @OA\Property(
 *         property="image",
 *         type="string",
 *         format="uri",
 *         maxLength=500,
 *         example="https://bucket.s3.amazonaws.com/uploads/images/profile/profile-picture-123.jpg",
 *         description="Profile image URL (must be a valid S3 URL)"
 *     )
 * )
 */
class UpsertUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     * 
     * Defines validation rules for user profile image updates:
     * - Image URL is required and must be a valid URL
     * - Image URL must be a valid S3 URL format
     * - Image URL must not exceed 500 characters
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> Array of validation rules
     */
    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'string',
                'url',
                'max:500',
            ],
        ];
    }
}
