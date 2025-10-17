<?php

namespace App\Repositories\Interfaces;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Budget Repository Interface
 * 
 * Defines contract for budget data access operations
 */
interface BudgetRepositoryInterface
{
    /**
     * Get paginated budgets for a specific user
     */
    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator;
    
    /**
     * Create a new budget for a user
     */
    public function createForUser(int $userId, array $data): Budget;
    
    /**
     * Find a budget belonging to a specific user
     */
    public function findUserBudget(int $userId, int $budgetId): ?Budget;
    
    /**
     * Update a budget model
     */
    public function update(Model $model, array $data): bool;
    
    /**
     * Delete a budget model
     */
    public function deleteModel(Budget $budget): bool;
}