<?php

namespace App\Actions\Transaction;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Show Transaction Action
 * 
 * Handles retrieving a specific user transaction by ID
 */
class ShowTransactionAction
{
    public function __construct(private TransactionRepositoryInterface $transactions)
    {}

    /**
     * Get specific transaction for authenticated user
     * 
     * @param int $id Transaction ID to retrieve
     * @return Transaction|null Transaction model or null if not found
     */
    public function handle(int $id): ?Transaction
    {
        $transaction = $this->transactions->find($id);

        if (!$transaction || !Gate::allows('view', $transaction)) {
            return null;
        }

        return $transaction;
    }
}