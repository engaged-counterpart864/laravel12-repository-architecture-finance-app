<?php

namespace App\Actions\Account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Interfaces\AccountRepositoryInterface;

/**
 * Delete Account Action
 * 
 * Handles deleting a user account by ID
 */
class DeleteAccountAction
{
    public function __construct(private AccountRepositoryInterface $accounts)
    {}

    /**
     * Delete account for authenticated user
     * 
     * @param int $id Account ID to delete
     * @return bool True if deleted successfully, false if not found or unauthorized
     */
    public function handle(int $id): bool
    {
        $account = $this->accounts->find($id);

        if (!$account || !Gate::allows('delete', $account)) {
            return false;
        }

        return $this->accounts->deleteModel($account);
    }
}


