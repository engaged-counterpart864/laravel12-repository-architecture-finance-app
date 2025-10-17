<?php

namespace App\Actions\Transaction;

use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Delete Transaction Action
 * 
 * Handles deleting a user transaction by ID
 */
class DeleteTransactionAction
{
    public function __construct(private TransactionRepositoryInterface $transactions)
    {}

    /**
     * Delete transaction for authenticated user
     * 
     * @param int $id Transaction ID to delete
     * @return bool True if deleted successfully, false if not found
     */
    public function handle(int $id): bool
    {
        $transaction = $this->transactions->find($id);
        
        if (!$transaction || !Gate::allows('delete', $transaction)) {
            return false;
        }

        return $this->transactions->deleteModel($transaction);
    }
}