<?php

namespace App\Repositories\Interfaces;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Transaction Repository Interface
 * 
 * Defines contract for transaction data access and reporting operations
 */
interface TransactionRepositoryInterface
{
    /**
     * Get paginated transactions for a user with optional filters
     */
    public function paginateByUser(int $userId, array $filters = [], int $perPage = 10): LengthAwarePaginator;
    
    /**
     * Create a new transaction for a user
     */
    public function createForUser(int $userId, array $data): Transaction;
    
    /**
     * Find a transaction belonging to a specific user
     */
    public function findUserTransaction(int $userId, int $transactionId): ?Transaction;
    
    /**
     * Update a transaction model
     */
    public function update(Model $model, array $data): bool;
    
    /**
     * Delete a transaction model
     */
    public function deleteModel(Transaction $transaction): bool;
    
    /**
     * Generate summary report (income vs expense) for date range
     */
    public function getSummaryReport(int $userId, string $from, string $to): array;
    
    /**
     * Generate category-wise report for date range
     */
    public function getCategoryReport(int $userId, string $from, string $to): array;
}