<?php

namespace App\Actions\Transaction;

use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

/**
 * Store Transaction Action
 * 
 * Handles creating a new transaction for authenticated user
 */
class StoreTransactionAction
{
    public function __construct(private TransactionRepositoryInterface $transactions)
    {}

    /**
     * Create a new transaction for authenticated user
     * 
     * @param StoreTransactionRequest $request Validated transaction data
     * @return Transaction|null Created transaction model or null if unauthorized
     */
    public function handle(StoreTransactionRequest $request): ?Transaction
    {
        if (!Gate::allows('create', Transaction::class)) {
            return null;
        }

        return $this->transactions->create($request->validated());
    }
}