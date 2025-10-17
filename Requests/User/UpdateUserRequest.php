<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Password;

/**
 * Update User Request
 * 
 * This request class handles validation for user profile updates.
 * It validates user data including personal information, contact details,
 * preferences, and optional password updates with confirmation.
 * 
 * @package App\Http\Requests\User
 * @version 1.0.0
 * 
 * @OA\Schema(
 *     schema="UpdateUserRequest",
 *     type="object",
 *     title="Update User Request",
 *     description="Request payload for updating user profile information",
 *     required={"first_name", "last_name", "email", "job_title"},
 *     @OA\Property(
 *         property="first_name",
 *         type="string",
 *         maxLength=255,
 *         example="laravel",
 *         description="User's first name"
 *     ),
 *     @OA\Property(
 *         property="last_name",
 *         type="string",
 *         maxLength=255,
 *         example="Sandbox",
 *         description="User's last name"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         maxLength=255,
 *         example="laravel@gmail.com",
 *         description="User's email address (must be unique)"
 *     ),
 *     @OA\Property(
 *         property="timezone",
 *         type="string",
 *         maxLength=255,
 *         example="Asia/Singapore",
 *         description="User's preferred timezone"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         maxLength=255,
 *         example="+1234567890",
 *         description="User's phone number"
 *     ),
 *     @OA\Property(
 *         property="language_code",
 *         type="string",
 *         maxLength=255,
 *         example="en",
 *         description="User's preferred language code"
 *     ),
 *     @OA\Property(
 *         property="job_title",
 *         type="string",
 *         maxLength=255,
 *         example="Gym Trainer",
 *         description="User's job title or position"
 *     ),
 *     @OA\Property(
 *         property="landing_page",
 *         type="string",
 *         maxLength=255,
 *         example="sale_dashboard",
 *         description="User's preferred landing page after login"
 *     ),
 *     @OA\Property(
 *         property="color_scheme",
 *         type="string",
 *         maxLength=255,
 *         example="dark",
 *         description="User's preferred color scheme (light/dark)"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         format="password",
 *         example="2P9X2tC*!gyNbPasMqUu",
 *         description="New password (optional, requires password_confirmation)"
 *     ),
 *     @OA\Property(
 *         property="password_confirmation",
 *         type="string",
 *         format="password",
 *         example="2P9X2tC*!gyNbPasMqUu",
 *         description="Password confirmation (required when password is provided)"
 *     ),
 *     @OA\Property(
 *         property="image",
 *         type="string",
 *         example="app/customers/developers/avatar-5778.jpg",
 *         description="Profile image url"
 *     )
 * )
 */
class UpdateUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     * 
     * Defines comprehensive validation rules for user profile updates including:
     * - Required fields: first_name, last_name, email, job_title
     * - Optional fields: timezone, phone, language_code, landing_page, color_scheme
     * - Password validation with confirmation requirement
     * - Email uniqueness validation (excluding current user)
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> Array of validation rules
     */
    public function rules(): array
    {
        $userId = $this->user()->id;
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
            'timezone' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:255'],
            'language_code' => ['sometimes', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'landing_page' => ['sometimes', 'string', 'max:255'],
            'color_scheme' => ['sometimes', 'string', 'max:255'],
            'password' => ['sometimes', 'confirmed', Password::defaults()],
            'image' => ['sometimes', 'string', 'max:255'],
        ];
    }
}