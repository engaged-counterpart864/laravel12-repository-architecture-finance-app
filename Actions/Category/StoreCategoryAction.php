<?php

namespace App\Actions\Category;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

/**
 * Store Category Action
 * 
 * Handles creating a new category for authenticated user
 */
class StoreCategoryAction
{
    public function __construct(private CategoryRepositoryInterface $categories)
    {}

    /**
     * Create a new category for authenticated user
     */
    public function handle(StoreCategoryRequest $request): ?Category
    {
        if (!Gate::allows('create', Category::class)) {
            return null;
        }

        $user = Auth::user();
        return $this->categories->createForUser($user->id, $request->validated());
    }
}