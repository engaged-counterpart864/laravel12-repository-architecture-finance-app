<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Category Repository Interface
 * 
 * Defines contract for category data access operations
 */
interface CategoryRepositoryInterface
{
    /**
     * Get paginated categories for a specific user
     */
    public function paginateByUser(int $userId, int $perPage = 10): LengthAwarePaginator;
    
    /**
     * Create a new category for a user
     */
    public function createForUser(int $userId, array $data): Category;
    
    /**
     * Find a category belonging to a specific user
     */
    public function findUserCategory(int $userId, int $categoryId): ?Category;
    
    /**
     * Update a category model
     */
    public function update(Model $model, array $data): bool;
    
    /**
     * Delete a category model
     */
    public function deleteModel(Category $category): bool;
}