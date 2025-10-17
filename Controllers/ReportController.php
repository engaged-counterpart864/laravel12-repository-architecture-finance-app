<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as Controller;
use App\Actions\Report\SummaryReportAction;
use App\Actions\Report\CategoryReportAction;
use App\Http\Resources\Report\SummaryReportResource;
use App\Http\Resources\Report\CategoryReportResource;
use App\Http\Requests\Report\ReportRequest;
use App\Services\ResponseService as Response;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Reports",
 *     description="Financial Reports APIs"
 * )
 */
class ReportController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/reports/summary",
     *     summary="Get income vs expense summary",
     *     operationId="reportsSummary",
     *     tags={"Reports"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="from", in="query", required=true, @OA\Schema(type="string", format="date")),
     *     @OA\Parameter(name="to", in="query", required=true, @OA\Schema(type="string", format="date")),
     *     @OA\Response(
     *         response=200,
     *         description="Summary report",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Summary report"),
     *             @OA\Property(property="data", ref="#/components/schemas/SummaryReportResource")
     *         )
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
    public function summary(ReportRequest $request, SummaryReportAction $action): JsonResponse
    {
        $report = $action->handle($request);
        return Response::success(SummaryReportResource::make($report), 'Summary report');
    }

    /**
     * @OA\Get(
     *     path="/api/v1/reports/by_category",
     *     summary="Get expense/income by category",
     *     operationId="reportsByCategory",
     *     tags={"Reports"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="from", in="query", required=true, @OA\Schema(type="string", format="date")),
     *     @OA\Parameter(name="to", in="query", required=true, @OA\Schema(type="string", format="date")),
     *     @OA\Response(
     *         response=200,
     *         description="Category report",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Category report"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CategoryReportResource")
     *             )
     *         )
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
    public function byCategory(ReportRequest $request, CategoryReportAction $action): JsonResponse
    {
        $report = $action->handle($request);
        return Response::success(CategoryReportResource::collection($report), 'Category report');
    }
}