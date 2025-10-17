<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    /**
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        parent::__construct($model);
    }

    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Account::query()
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function createForUser(int $userId, array $data): Account
    {
        $data['user_id'] = $userId;
        return Account::create($data);
    }

    public function findUserAccount(int $userId, int $accountId): ?Account
    {
        return Account::query()
            ->where('user_id', $userId)
            ->find($accountId);
    }

    public function deleteModel(Account $account): bool
    {
        return (bool) $account->delete();
    }
}


