<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;

/**
 * Account Policy
 * 
 * Handles authorization for account-related operations
 */
class AccountPolicy
{
    /**
     * Determine if user can create accounts
     * 
     * @param User $user Authenticated user
     * @return bool True if user can create accounts
     */
    public function create(User $user): bool
    {
        return true; // Any authenticated user can create accounts
    }

    /**
     * Determine if user can view the account
     * 
     * @param User $user Authenticated user
     * @param Account $account Account to view
     * @return bool True if user owns the account
     */
    public function view(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determine if user can update the account
     * 
     * @param User $user Authenticated user
     * @param Account $account Account to update
     * @return bool True if user owns the account
     */
    public function update(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }

    /**
     * Determine if user can delete the account
     * 
     * @param User $user Authenticated user
     * @param Account $account Account to delete
     * @return bool True if user owns the account
     */
    public function delete(User $user, Account $account): bool
    {
        return $user->id === $account->user_id;
    }
}