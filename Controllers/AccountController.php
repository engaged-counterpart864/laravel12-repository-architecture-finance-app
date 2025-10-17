<?php

namespace App\Http\Controllers;

use App\Actions\Account\DeleteAccountAction;
use App\Actions\Account\IndexAccountsAction;
use App\Actions\Account\ShowAccountAction;
use App\Actions\Account\StoreAccountAction;
use App\Actions\Account\UpdateAccountAction;
use App\Http\Controllers\BaseController as Controller;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Http\Resources\Account\AccountResource;
use App\Services\ResponseService as Response;
use Illuminate\Http\JsonResponse;

/**
 * Account Controller
 *
 * Handles account-related API endpoints.
 *
 * @OA\Tag(
 *     name="Accounts",
 *     description="Accounts CRUD APIs"
 * )
 */
class AccountController extends Controller
{
    /**
     * List accounts
     *
     * @OA\Get(
     *     path="/api/v1/accounts",
     *     summary="List accounts",
     *     description="Get a paginated list of user accounts",
     *     operationId="accountsIndex",
     *     tags={"Accounts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Accounts list",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function index(IndexAccountsAction $action): JsonResponse
    {
        $items = $action->handle();
        return Response::paginated(AccountResource::collection($items), 'Accounts list');
    }

    /**
     * Create account
     *
     * @OA\Post(
     *     path="/api/v1/accounts",
     *     summary="Create account",
     *     description="Create a new account",
     *     operationId="accountsStore",
     *     tags={"Accounts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"name","type"},
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="type", type="string"),
     *                 @OA\Property(property="balance", type="number", format="float")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Account created",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function store(StoreAccountRequest $request, StoreAccountAction $action): JsonResponse
    {
        $account = $action->handle($request);
        return Response::created(AccountResource::make($account), 'Account created');
    }

    /**
     * Get account by id
     *
     * @OA\Get(
     *     path="/api/v1/accounts/{id}",
     *     summary="Get account",
     *     description="Get account by ID",
     *     operationId="accountsShow",
     *     tags={"Accounts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Account details",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function show(int $id, ShowAccountAction $action): JsonResponse
    {
        $account = $action->handle($id);
        if (!$account) {
            return Response::notFound('Account not found');
        }
        return Response::success(AccountResource::make($account), 'Account details');
    }

    /**
     * Update account
     *
     * @OA\Put(
     *     path="/api/v1/accounts/{id}",
     *     summary="Update account",
     *     description="Update an existing account",
     *     operationId="accountsUpdate",
     *     tags={"Accounts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Account updated",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function update(int $id, UpdateAccountRequest $request, UpdateAccountAction $action): JsonResponse
    {
        $account = $action->handle($id, $request);
        if (!$account) {
            return Response::notFound('Account not found');
        }
        return Response::success(AccountResource::make($account), 'Account updated');
    }

    /**
     * Delete account
     *
     * @OA\Delete(
     *     path="/api/v1/accounts/{id}",
     *     summary="Delete account",
     *     description="Delete an account by ID",
     *     operationId="accountsDelete",
     *     tags={"Accounts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Account deleted",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      ),
     * )
     */
    public function destroy(int $id, DeleteAccountAction $action): JsonResponse
    {
        $deleted = $action->handle($id);
        if (!$deleted) {
            return Response::notFound('Account not found');
        }
        return Response::success(null, 'Account deleted');
    }
}


