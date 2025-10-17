<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

/**
 * Category Policy
 * 
 * Handles authorization for category-related operations
 */
class CategoryPolicy
{
    /**
     * Determine if user can create categories
     * 
     * @param User $user Authenticated user
     * @return bool True if user can create categories
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if user can view the category
     * 
     * @param User $user Authenticated user
     * @param Category $category Category to view
     * @return bool True if user owns the category
     */
    public function view(User $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }

    /**
     * Determine if user can update the category
     * 
     * @param User $user Authenticated user
     * @param Category $category Category to update
     * @return bool True if user owns the category
     */
    public function update(User $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }

    /**
     * Determine if user can delete the category
     * 
     * @param User $user Authenticated user
     * @param Category $category Category to delete
     * @return bool True if user owns the category
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }
}