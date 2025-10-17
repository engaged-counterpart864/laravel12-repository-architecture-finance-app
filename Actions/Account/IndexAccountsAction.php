<?php

namespace App\Actions\Account;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Interfaces\AccountRepositoryInterface;

/**
 * Index Accounts Action
 * 
 * Handles retrieving paginated list of user accounts
 */
class IndexAccountsAction
{
    public function __construct(private AccountRepositoryInterface $accounts)
    {}

    /**
     * Get paginated accounts for authenticated user using policy
     * 
     * @return LengthAwarePaginator
     */
    public function handle(): LengthAwarePaginator
    {
        $accounts = $this->accounts->paginate((int) request('per_page', 10));
        
        // Filter accounts based on policy authorization
        $accounts->getCollection()->transform(function ($account) {
            return Gate::allows('view', $account) ? $account : null;
        })->filter();
        
        return $accounts;
    }
}


