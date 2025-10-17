<?php

namespace App\Actions\Account;

use App\Models\Account;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Interfaces\AccountRepositoryInterface;

/**
 * Show Account Action
 * 
 * Handles retrieving a specific user account by ID
 */
class ShowAccountAction
{
    public function __construct(private AccountRepositoryInterface $accounts)
    {}

    /**
     * Get specific account for authenticated user
     * 
     * @param int $id Account ID to retrieve
     * @return Account|null Account model or null if not found
     */
    public function handle(int $id): ?Account
    {
        $account = $this->accounts->find($id);

        if (!$account || !Gate::allows('view', $account)) {
            return null;
        }

        return $account;
    }
}


