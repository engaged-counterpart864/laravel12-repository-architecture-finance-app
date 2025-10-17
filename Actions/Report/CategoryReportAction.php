<?php

namespace App\Actions\Report;

use App\Http\Requests\Report\ReportRequest;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

/**
 * Category Report Action
 * 
 * Generates category-wise income/expense breakdown for date range
 */
class CategoryReportAction
{
    public function __construct(private TransactionRepositoryInterface $transactions)
    {}

    /**
     * Generate category report for authenticated user within date range
     */
    public function handle(ReportRequest $request): array
    {
        $user = Auth::user();
        $transactions = $this->transactions->getTransactionsForReport(
            $request->input('from'),
            $request->input('to')
        );
        
        $authorizedTransactions = $transactions->filter(function ($transaction) {
            return Gate::allows('view', $transaction);
        });
        
        return $this->transactions->buildCategoryReport($authorizedTransactions);
    }
}