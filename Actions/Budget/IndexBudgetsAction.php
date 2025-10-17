<?php

namespace App\Actions\Budget;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Interfaces\BudgetRepositoryInterface;

/**
 * Index Budgets Action
 * 
 * Handles retrieving paginated list of user budgets
 */
class IndexBudgetsAction
{
    public function __construct(private BudgetRepositoryInterface $budgets)
    {}

    /**
     * Get paginated budgets for authenticated user using policy
     * 
     * @return LengthAwarePaginator
     */
    public function handle(): LengthAwarePaginator
    {
        $budgets = $this->budgets->paginate((int) request('per_page', 10));
        
        $budgets->getCollection()->transform(function ($budget) {
            return Gate::allows('view', $budget) ? $budget : null;
        })->filter();
        
        return $budgets;
    }
}