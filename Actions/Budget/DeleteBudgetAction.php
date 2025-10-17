<?php

namespace App\Actions\Budget;

use App\Repositories\Interfaces\BudgetRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Delete Budget Action
 * 
 * Handles deleting a user budget by ID
 */
class DeleteBudgetAction
{
    public function __construct(private BudgetRepositoryInterface $budgets)
    {}

    /**
     * Delete budget for authenticated user
     * 
     * @param int $id Budget ID to delete
     * @return bool True if deleted successfully, false if not found
     */
    public function handle(int $id): bool
    {
        $budget = $this->budgets->find($id);
        
        if (!$budget || !Gate::allows('delete', $budget)) {
            return false;
        }

        return $this->budgets->deleteModel($budget);
    }
}