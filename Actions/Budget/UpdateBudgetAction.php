<?php

namespace App\Actions\Budget;

use App\Http\Requests\Budget\UpdateBudgetRequest;
use App\Models\Budget;
use App\Repositories\Interfaces\BudgetRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Update Budget Action
 * 
 * Handles updating an existing user budget
 */
class UpdateBudgetAction
{
    public function __construct(private BudgetRepositoryInterface $budgets)
    {}

    /**
     * Update budget for authenticated user
     * 
     * @param UpdateBudgetRequest $request Validated update data
     * @param int $id Budget ID to update
     * @return Budget|null Updated budget with category or null if not found
     */
    public function handle(UpdateBudgetRequest $request, int $id): ?Budget
    {
        $budget = $this->budgets->find($id);
        
        if (!$budget || !Gate::allows('update', $budget)) {
            return null;
        }

        $this->budgets->update($budget, $request->validated());
        return $budget->fresh(['category']);
    }
}