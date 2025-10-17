<?php

namespace App\Actions\Category;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

/**
 * Index Categories Action
 * 
 * Handles retrieving paginated list of user categories
 */
class IndexCategoriesAction
{
    public function __construct(private CategoryRepositoryInterface $categories)
    {}

    /**
     * Get paginated categories for authenticated user using policy
     */
    public function handle(): LengthAwarePaginator
    {
        $categories = $this->categories->paginate((int) request('per_page', 10));
        
        $categories->getCollection()->transform(function ($category) {
            return Gate::allows('view', $category) ? $category : null;
        })->filter();
        
        return $categories;
    }
}