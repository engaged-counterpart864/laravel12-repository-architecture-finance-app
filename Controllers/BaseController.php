<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="Laravel API",
 *     version="1.0.0",
 *     description="LaravelAPI Documentation",
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8080",
 *     description="Local server"
 * )
 * 
 * @OA\Schema(
 *     schema="ErrorResponse",
 *     type="object",
 *     title="Error Response",
 *     description="Standard error response structure",
 *     required={"success", "message"},
 *     @OA\Property(property="success", type="boolean", example=false, description="Indicates if the request was successful"),
 *     @OA\Property(property="message", type="string", example="An error occurred", description="Error message describing what went wrong"),
 *     @OA\Property(property="errors", type="object", description="Validation errors (only present for validation failures)", additionalProperties={"type": "array", "items": {"type": "string"}})
 * )
 * 
 * @OA\Schema(
 *     schema="SuccessResponse",
 *     type="object",
 *     title="Success Response",
 *     description="Standard success response structure",
 *     required={"success", "message"},
 *     @OA\Property(property="success", type="boolean", example=true, description="Indicates if the request was successful"),
 *     @OA\Property(property="message", type="string", example="Operation completed successfully", description="Success message"),
 *     @OA\Property(property="data", description="Response data (varies by endpoint)")
 * )
 * 
 * @OA\Schema(
 *     schema="ValidationErrorResponse",
 *     type="object",
 *     title="Validation Error Response",
 *     description="Response structure for validation errors",
 *     required={"success", "message", "errors"},
 *     @OA\Property(property="success", type="boolean", example=false, description="Indicates if the request was successful"),
 *     @OA\Property(property="message", type="string", example="Validation failed", description="Error message"),
 *     @OA\Property(property="errors", type="object", description="Validation errors by field", additionalProperties={"type": "array", "items": {"type": "string"}})
 * )
 * 
 * @OA\Schema(
 *     schema="BaseListRequest",
 *     type="object",
 *     @OA\Property(property="page", type="integer", minimum=1, example=1, description="Page number for pagination"),
 *     @OA\Property(property="per_page", type="integer", minimum=1, example=10, description="Number of items per page"),
 *     @OA\Property(property="sort_by", type="string", enum={"created_at"}, example="created_at", description="Field to sort by"),
 *     @OA\Property(property="sort_order", type="string", enum={"asc", "desc"}, example="desc", description="Sort order (ascending or descending)")
 * )
 * 
 * @OA\Schema(
 *     schema="LoginResponse",
 *     type="object",
 *     required={"token", "token_type", "user"},
 *     @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...", description="JWT access token"),
 *     @OA\Property(property="token_type", type="string", example="Bearer", description="Token type"),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource", description="Authenticated user data")
 * )
 * 
 * @OA\Schema(
 *     schema="RegisterRequest",
 *     type="object",
 *     required={"email","password"},
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="secret1234")
 * )
 * 
 * @OA\Schema(
 *     schema="LoginRequest",
 *     type="object",
 *     required={"email","password"},
 *     @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="secret1234")
 * )
 * 
 * @OA\Schema(
 *     schema="AuthRegisterResponse",
 *     type="object",
 *     required={"success","message"},
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="User registered successfully")
 * )
 * 
 * @OA\Schema(
 *     schema="AuthLoginResponse",
 *     type="object",
 *     required={"success","message"},
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="User Logged in successfully")
 * )
 * 
 */
abstract class BaseController
{
    //
}
