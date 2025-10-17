<?php

namespace App\Actions\Category;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Gate;

/**
 * Delete Category Action
 * 
 * Handles deleting a user category by ID
 */
class DeleteCategoryAction
{
    public function __construct(private CategoryRepositoryInterface $categories)
    {}

    /**
     * Delete category for authenticated user
     * 
     * @param int $id Category ID to delete
     * @return bool True if deleted successfully, false if not found
     */
    public function handle(int $id): bool
    {
        $category = $this->categories->find($id);
        
        if (!$category || !Gate::allows('delete', $category)) {
            return false;
        }

        return $this->categories->deleteModel($category);
    }
}