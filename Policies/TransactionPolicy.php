<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

/**
 * Transaction Policy
 * 
 * Handles authorization for transaction-related operations
 */
class TransactionPolicy
{
    /**
     * Determine if user can create transactions
     * 
     * @param User $user Authenticated user
     * @return bool True if user can create transactions
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can view the transaction
     * 
     * @param User $user Authenticated user
     * @param Transaction $transaction Transaction to view
     * @return bool True if user owns the transaction
     */
    public function view(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }

    /**
     * Determine if user can update the transaction
     * 
     * @param User $user Authenticated user
     * @param Transaction $transaction Transaction to update
     * @return bool True if user owns the transaction
     */
    public function update(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }

    /**
     * Determine if user can delete the transaction
     * 
     * @param User $user Authenticated user
     * @param Transaction $transaction Transaction to delete
     * @return bool True if user owns the transaction
     */
    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
    }
}