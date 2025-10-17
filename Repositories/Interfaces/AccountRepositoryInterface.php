<?php

namespace App\Repositories\Interfaces;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface AccountRepositoryInterface
{
    /**
     * Paginate accounts for a user id.
     *
     * @param int $userId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator;

    /**
     * Create account for user
     *
     * @param int $userId
     * @param array $data
     * @return Account
     */
    public function createForUser(int $userId, array $data): Account;

    /**
     * Find user-owned account by id
     *
     * @param int $userId
     * @param int $accountId
     * @return Account|null
     */
    public function findUserAccount(int $userId, int $accountId): ?Account;

    /**
     * Update a model instance
     *
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function update(Model $model, array $data): bool;

    /**
     * Delete account model
     *
     * @param Account $account
     * @return bool
     */
    public function deleteModel(Account $account): bool;
}


