<?php

namespace App\Actions\Budget;

use App\Http\Requests\Budget\StoreBudgetRequest;
use App\Models\Budget;
use App\Repositories\Interfaces\BudgetRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

/**
 * Store Budget Action
 * 
 * Handles creating a new budget for authenticated user
 */
class StoreBudgetAction
{
    public function __construct(private BudgetRepositoryInterface $budgets)
    {}

    /**
     * Create a new budget for authenticated user
     * 
     * @param StoreBudgetRequest $request Validated budget data
     * @return Budget|null Created budget model or null if unauthorized
     */
    public function handle(StoreBudgetRequest $request): ?Budget
    {
        if (!Gate::allows('create', Budget::class)) {
            return null;
        }

        $user = Auth::user();
        return $this->budgets->createForUser($user->id, $request->validated());
    }
}