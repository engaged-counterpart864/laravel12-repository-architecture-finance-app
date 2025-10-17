<?php

namespace App\Actions\Account;

use App\Http\Requests\Account\UpdateAccountRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Account;
use App\Repositories\Interfaces\AccountRepositoryInterface;

/**
 * Update Account Action
 * 
 * Handles updating an existing user account
 */
class UpdateAccountAction
{
    public function __construct(private AccountRepositoryInterface $accounts)
    {}

    /**
     * Update account for authenticated user
     * 
     * @param int $id Account ID to update
     * @param UpdateAccountRequest $request Validated update data
     * @return Account|null Updated account or null if not found
     */
    public function handle(int $id, UpdateAccountRequest $request): ?Account
    {
        $account = $this->accounts->find($id);

        if (!$account || !Gate::allows('update', $account)) {
            return null;
        }

        $this->accounts->update($account, $request->only(['name','type','balance']));

        return $account;
    }
}


