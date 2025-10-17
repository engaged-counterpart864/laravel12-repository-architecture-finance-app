<?php

namespace App\Actions\Transaction;

use App\Http\Requests\Transaction\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Update Transaction Action
 * 
 * Handles updating an existing user transaction
 */
class UpdateTransactionAction
{
    public function __construct(private TransactionRepositoryInterface $transactions)
    {}

    /**
     * Update transaction for authenticated user
     * 
     * @param UpdateTransactionRequest $request Validated update data
     * @param int $id Transaction ID to update
     * @return Transaction|null Updated transaction with relations or null if not found
     */
    public function handle(UpdateTransactionRequest $request, int $id): ?Transaction
    {
        $transaction = $this->transactions->find($id);
        
        if (!$transaction || !Gate::allows('update', $transaction)) {
            return null;
        }

        $this->transactions->update($transaction, $request->validated());
        return $transaction->fresh(['account', 'category']);
    }
}