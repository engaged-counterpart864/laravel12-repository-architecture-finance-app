<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Base Repository Class
 * 
 * This abstract class serves as the foundation for all repository classes
 * in the application. It implements the BaseRepositoryInterface and provides
 * a common structure for data access operations.
 * 
 * @package App\Repositories
 * @version 1.0.0
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The model instance
     * 
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     * 
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Find a model by its ID
     * 
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Delete a model by its ID
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->delete($id);
    }

    /**
     * Get the latest model
     * 
     * @return Collection
     */
    public function getLatest(): Collection
    {
        return $this->model->latest()->get();
    }

    /**
     * Create a new model instance
     * 
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update model instance
     * 
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }
}