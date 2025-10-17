<?php

namespace App\Actions\Category;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Show Category Action
 * 
 * Handles retrieving a specific user category by ID
 */
class ShowCategoryAction
{
    public function __construct(private CategoryRepositoryInterface $categories)
    {}

    /**
     * Get specific category for authenticated user
     * 
     * @param int $id Category ID to retrieve
     * @return Category|null Category model or null if not found
     */
    public function handle(int $id): ?Category
    {
        $category = $this->categories->find($id);

        if (!$category || !Gate::allows('view', $category)) {
            return null;
        }

        return $category;
    }
}