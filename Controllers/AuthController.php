<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as Controller;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\ResponseService as Response;

/**
 * Auth Controller
 * 
 * Handles auth-related API endpoints.
 * 
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication APIs"
 * )
 * 
 * @package App\Http\Controllers\Auth
 * @version 1.0.0
 */
class AuthController extends Controller
{
    /**
     * Register a new user
     * 
     * @OA\Post(
     *     path="/api/v1/auth/register",
     *     summary="Register user",
     *     description="Register a new user account",
     *     operationId="authRegister",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/RegisterRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered",
     *         @OA\JsonContent(ref="#/components/schemas/AuthRegisterResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
     *     )
     * )
     */
    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        $action->handle($request);

        return Response::success('User registered successfully', 201);
    }

    /**
     * Login and get token
     * 
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Login",
     *     description="Authenticate user and get token",
     *     operationId="authLogin",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/LoginRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Logged in",
     *         @OA\JsonContent(ref="#/components/schemas/AuthLoginResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
     *     )
     * )
     */
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        $result = $action->handle($request);
        if (isset($result['error'])) {
            return Response::error($result['error'], 401);
        }

        return Response::success($result, 'User Logged in successfully');
    }

    /**
     * Get current user
     * 
     * @OA\Get(
     *     path="/api/v1/auth/me",
     *     summary="Current user",
     *     description="Get the currently authenticated user",
     *     operationId="authMe",
     *     tags={"Auth"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Current user",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Current user"),
     *             @OA\Property(property="data", ref="#/components/schemas/UserResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function me(Request $request): JsonResponse
    {
        return Response::success(UserResource::make($request->user()), 'Current user', 200);
    }
}
