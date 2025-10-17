<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as Controller;
use App\Actions\Budget\IndexBudgetsAction;
use App\Actions\Budget\StoreBudgetAction;
use App\Actions\Budget\ShowBudgetAction;
use App\Actions\Budget\UpdateBudgetAction;
use App\Actions\Budget\DeleteBudgetAction;
use App\Http\Resources\Budget\BudgetResource;
use App\Http\Requests\Budget\StoreBudgetRequest;
use App\Http\Requests\Budget\UpdateBudgetRequest;
use App\Services\ResponseService as Response;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Budgets",
 *     description="Budgets CRUD APIs"
 * )
 */
class BudgetController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/budgets",
     *     summary="List budgets",
     *     operationId="budgetsIndex",
     *     tags={"Budgets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Budgets list",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function index(IndexBudgetsAction $action): JsonResponse
    {
        $budgets = $action->handle();
        return Response::success(BudgetResource::collection($budgets)->response()->getData(true));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/budgets",
     *     summary="Create budget",
     *     operationId="budgetsStore",
     *     tags={"Budgets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/StoreBudgetRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Budget created",
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
    public function store(StoreBudgetRequest $request, StoreBudgetAction $action): JsonResponse
    {
        $budget = $action->handle($request);
        return Response::success(BudgetResource::make($budget), 'Budget created successfully', 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/budgets/{id}",
     *     summary="Get budget",
     *     operationId="budgetsShow",
     *     tags={"Budgets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Budget details",
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
    public function show(int $id, ShowBudgetAction $action): JsonResponse
    {
        $budget = $action->handle($id);
        
        if (!$budget) {
            return Response::error('Budget not found', 404);
        }

        return Response::success(BudgetResource::make($budget));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/budgets/{id}",
     *     summary="Update budget",
     *     operationId="budgetsUpdate",
     *     tags={"Budgets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/UpdateBudgetRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Budget updated",
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
    public function update(UpdateBudgetRequest $request, int $id, UpdateBudgetAction $action): JsonResponse
    {
        $budget = $action->handle($request, $id);
        
        if (!$budget) {
            return Response::error('Budget not found', 404);
        }

        return Response::success(BudgetResource::make($budget), 'Budget updated successfully');
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/budgets/{id}",
     *     summary="Delete budget",
     *     operationId="budgetsDelete",
     *     tags={"Budgets"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(
     *         response=200,
     *         description="Budget deleted",
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
    public function destroy(int $id, DeleteBudgetAction $action): JsonResponse
    {
        $deleted = $action->handle($id);
        
        if (!$deleted) {
            return Response::error('Budget not found', 404);
        }

        return Response::success(null, 'Budget deleted successfully');
    }
}