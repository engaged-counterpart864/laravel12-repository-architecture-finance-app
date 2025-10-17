<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as Controller;
use App\Actions\Transaction\IndexTransactionsAction;
use App\Actions\Transaction\StoreTransactionAction;
use App\Actions\Transaction\ShowTransactionAction;
use App\Actions\Transaction\UpdateTransactionAction;
use App\Actions\Transaction\DeleteTransactionAction;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Requests\Transaction\IndexTransactionRequest;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Services\ResponseService as Response;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Transactions",
 *     description="Transactions CRUD APIs"
 * )
 */
class TransactionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/transactions",
     *     summary="List transactions",
     *     operationId="transactionsIndex",
     *     tags={"Transactions"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/IndexTransactionRequest")
     *     @OA\Response(
     *         response=200,
     *         description="Transactions list",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function index(IndexTransactionRequest $request, IndexTransactionsAction $action): JsonResponse
    {
        $transactions = $action->handle($request);
        return Response::success(TransactionResource::collection($transactions)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/transactions",
     *     summary="Create transaction",
     *     operationId="transactionsStore",
     *     tags={"Transactions"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/StoreTransactionRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Transaction created",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function store(StoreTransactionRequest $request, StoreTransactionAction $action): JsonResponse
    {
        $transaction = $action->handle($request);
        return Response::success(TransactionResource::make($transaction), 'Transaction created successfully', 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/transactions/{id}",
     *     summary="Get transaction",
     *     operationId="transactionsShow",
     *     tags={"Transactions"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Transaction details",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function show(int $id, ShowTransactionAction $action): JsonResponse
    {
        $transaction = $action->handle($id);
        
        if (!$transaction) {
            return Response::error('Transaction not found', 404);
        }

        return Response::success(TransactionResource::make($transaction));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/transactions/{id}",
     *     summary="Update transaction",
     *     operationId="transactionsUpdate",
     *     tags={"Transactions"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/UpdateTransactionRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transaction updated",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function update(UpdateTransactionRequest $request, int $id, UpdateTransactionAction $action): JsonResponse
    {
        $transaction = $action->handle($request, $id);
        
        if (!$transaction) {
            return Response::error('Transaction not found', 404);
        }

        return Response::success(TransactionResource::make($transaction), 'Transaction updated successfully');
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/transactions/{id}",
     *     summary="Delete transaction",
     *     operationId="transactionsDelete",
     *     tags={"Transactions"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Transaction deleted",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function destroy(int $id, DeleteTransactionAction $action): JsonResponse
    {
        $deleted = $action->handle($id);
        
        if (!$deleted) {
            return Response::error('Transaction not found', 404);
        }

        return Response::success(null, 'Transaction deleted successfully');
    }
}