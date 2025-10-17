<?php

namespace App\Actions\Account;

use App\Http\Requests\Account\StoreAccountRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Repositories\Interfaces\AccountRepositoryInterface;

/**
 * Store Account Action
 * 
 * Handles creating a new account for authenticated user
 */
class StoreAccountAction
{
    public function __construct(private AccountRepositoryInterface $accounts)
    {}

    /**
     * Create a new account for authenticated user
     * 
     * @param StoreAccountRequest $request Validated account data
     * @return Account|null Created account model or null if unauthorized
     */
    public function handle(StoreAccountRequest $request): ?Account
    {
        if (!Gate::allows('create', Account::class)) {
            return null;
        }

        $user = Auth::user();
        return $this->accounts->createForUser($user->id, [
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'balance' => $request->input('balance', 0),
        ]);
    }
}


