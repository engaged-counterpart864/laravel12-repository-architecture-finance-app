<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Category Repository
 * 
 * Handles category data access operations
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Get paginated categories for a specific user
     */
    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Category::query()
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    /**
     * Create a new category for a user
     */
    public function createForUser(int $userId, array $data): Category
    {
        $data['user_id'] = $userId;
        return Category::create($data);
    }

    /**
     * Find a category belonging to a specific user
     */
    public function findUserCategory(int $userId, int $categoryId): ?Category
    {
        return Category::query()
            ->where('user_id', $userId)
            ->find($categoryId);
    }

    /**
     * Delete a category model
     */
    public function deleteModel(Category $category): bool
    {
        return (bool) $category->delete();
    }
}