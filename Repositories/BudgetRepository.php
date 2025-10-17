<?php

namespace App\Repositories;

use App\Models\Budget;
use App\Repositories\Interfaces\BudgetRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BudgetRepository extends BaseRepository implements BudgetRepositoryInterface
{
    public function __construct(Budget $model)
    {
        parent::__construct($model);
    }

    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Budget::query()
            ->where('user_id', $userId)
            ->with(['category'])
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    public function createForUser(int $userId, array $data): Budget
    {
        $data['user_id'] = $userId;
        return Budget::create($data);
    }

    public function findUserBudget(int $userId, int $budgetId): ?Budget
    {
        return Budget::query()
            ->where('user_id', $userId)
            ->with(['category'])
            ->find($budgetId);
    }

    public function deleteModel(Budget $budget): bool
    {
        return (bool) $budget->delete();
    }
}