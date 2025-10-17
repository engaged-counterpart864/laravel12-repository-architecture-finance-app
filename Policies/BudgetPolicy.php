<?php

namespace App\Policies;

use App\Models\Budget;
use App\Models\User;

/**
 * Budget Policy
 * 
 * Handles authorization for budget-related operations
 */
class BudgetPolicy
{
    /**
     * Determine if user can create budgets
     * 
     * @param User $user Authenticated user
     * @return bool True if user can create budgets
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can view the budget
     * 
     * @param User $user Authenticated user
     * @param Budget $budget Budget to view
     * @return bool True if user owns the budget
     */
    public function view(User $user, Budget $budget): bool
    {
        return $user->id === $budget->user_id;
    }

    /**
     * Determine if user can update the budget
     * 
     * @param User $user Authenticated user
     * @param Budget $budget Budget to update
     * @return bool True if user owns the budget
     */
    public function update(User $user, Budget $budget): bool
    {
        return $user->id === $budget->user_id;
    }

    /**
     * Determine if user can delete the budget
     * 
     * @param User $user Authenticated user
     * @param Budget $budget Budget to delete
     * @return bool True if user owns the budget
     */
    public function delete(User $user, Budget $budget): bool
    {
        return $user->id === $budget->user_id;
    }
}