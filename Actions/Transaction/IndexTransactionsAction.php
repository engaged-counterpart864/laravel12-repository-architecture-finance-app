<?php

namespace App\Actions\Transaction;

use App\Http\Requests\Transaction\IndexTransactionRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

/**
 * Index Transactions Action
 * 
 * Handles retrieving filtered and paginated list of user transactions
 */
class IndexTransactionsAction
{
    public function __construct(private TransactionRepositoryInterface $transactions)
    {}

    /**
     * Get filtered and paginated transactions for authenticated user using policy
     */
    public function handle(IndexTransactionRequest $request): LengthAwarePaginator
    {
        $filters = $request->only(['account_id', 'category_id', 'type', 'date_from', 'date_to']);
        $transactions = $this->transactions->paginateWithFilters($filters, (int) $request->input('per_page', 10));
        
        $transactions->getCollection()->transform(function ($transaction) {
            return Gate::allows('view', $transaction) ? $transaction : null;
        })->filter();
        
        return $transactions;
    }
}