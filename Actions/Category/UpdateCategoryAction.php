<?php

namespace App\Actions\Category;

use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Update Category Action
 * 
 * Handles updating an existing user category
 */
class UpdateCategoryAction
{
    public function __construct(private CategoryRepositoryInterface $categories)
    {}

    /**
     * Update category for authenticated user
     * 
     * @param UpdateCategoryRequest $request Validated update data
     * @param int $id Category ID to update
     * @return Category|null Updated category or null if not found
     */
    public function handle(UpdateCategoryRequest $request, int $id): ?Category
    {
        $category = $this->categories->find($id);
        
        if (!$category || !Gate::allows('update', $category)) {
            return null;
        }

        $this->categories->update($category, $request->validated());
        return $category->fresh();
    }
}