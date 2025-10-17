<?php

namespace App\Http\Controllers;

use App\Actions\User\UpsertUserAction;
use App\Http\Controllers\BaseController;
use App\Http\Requests\User\UpsertUserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\ResponseService as Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * User Controller
 * 
 * Handles user-related API endpoints including profile management.
 * This controller provides methods for retrieving user profile information
 * and managing user data through the API.
 * 
 * @OA\Tag(
 *     name="Users",
 *     description="User management and profile operations"
 * )
 * 
 * @package App\Http\Controllers\User
 * @version 1.0.0
 */
class UserController extends BaseController
{
    /**
     * Get user profile information
     * 
     * Retrieves the authenticated user's profile data including associated
     * customer information. This endpoint returns comprehensive user details
     * formatted through the UserResource.
     * 
     * @OA\Get(
     *     path="/api/users/profile",
     *     summary="Get user profile",
     *     description="Retrieve the authenticated user's profile information including customer details",
     *     operationId="getUserProfile",
     *     tags={"Users"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="User profile retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="User profile fetched successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/UserResource"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="User Not Found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     * 
     * @return JsonResponse Returns a JSON response containing the user profile data
     */
    public function profile(Request $request): JsonResponse
    {
        return Response::success(UserResource::make($request->user()), 'User profile fetched successfully');
    }

    /**
     * Update User Profile
     *
     * Updates the authenticated user's profile information.
     *
     * @OA\Put(
     *     path="/api/users/profile",
     *     summary="Update user profile",
     *     description="Update the authenticated user's profile information.",
     *     operationId="updateUserProfile",
     *     tags={"Users"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/UpdateUserRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User profile updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User Not Found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="User Profile Update Failed",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    // public function updateProfile(UpdateUserRequest $request, UpdateUserAction $action): JsonResponse
    // {   
    //     if ($action->request($request)->handle($request->user())) {
    //         return Response::success('User profile updated successfully');
    //     }

    //     return Response::error('User profile update failed');
    // }

    /**
     * Update User Profile Image
     *
     * Updates only the profile image for the authenticated user.
     * This endpoint allows partial updates specifically for the image field.
     *
     * @OA\Patch(
     *     path="/api/users/profile",
     *     summary="Update user profile image",
     *     description="Update only the profile image for the authenticated user",
     *     operationId="upsertUserImage",
     *     tags={"Users"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/UpsertUserRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User profile updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User Not Found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="User Profile Update Failed",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     * 
     * @param UpsertUserRequest $request The validated image update request
     * @param UpsertUserAction $action The update image action
     * @return JsonResponse Returns a JSON response with the update result
     */
    // public function patchProfile(UpsertUserRequest $request, UpsertUserAction $action): JsonResponse
    // {
    //     if ($action->request($request)->handle($request->user())) {
    //         return Response::success('User profile updated successfully');
    //     }

    //     return Response::error('User profile update failed');
    // }
}
