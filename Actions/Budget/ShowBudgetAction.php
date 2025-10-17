<?php

namespace App\Actions\Budget;

use App\Models\Budget;
use App\Repositories\Interfaces\BudgetRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Show Budget Action
 * 
 * Handles retrieving a specific user budget by ID
 */
class ShowBudgetAction
{
    public function __construct(private BudgetRepositoryInterface $budgets)
    {}

    /**
     * Get specific budget for authenticated user
     * 
     * @param int $id Budget ID to retrieve
     * @return Budget|null Budget model or null if not found
     */
    public function handle(int $id): ?Budget
    {
        $budget = $this->budgets->find($id);

        if (!$budget || !Gate::allows('view', $budget)) {
            return null;
        }

        return $budget;
    }
}