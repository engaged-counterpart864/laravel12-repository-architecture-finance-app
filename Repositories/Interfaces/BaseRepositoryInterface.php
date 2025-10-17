<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Base Repository Interface
 * 
 * This interface defines the contract for all repository classes
 * in the application. It provides a common structure for data access
 * operations and ensures consistency across all repositories.
 * 
 * @package App\Repositories\Interfaces
 * @version 1.0.0
 */
interface BaseRepositoryInterface
{
    public function find(int $id): ?Model;

    public function delete(int $id): bool;

    public function getLatest(): Collection;
    
    public function create(array $data): Model;
    
    public function update(Model $model, array $data): bool;
}