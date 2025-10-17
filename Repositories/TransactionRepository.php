<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    public function paginateByUser(int $userId, array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Transaction::query()
            ->where('user_id', $userId)
            ->with(['account', 'category']);

        if (!empty($filters['account_id'])) {
            $query->where('account_id', $filters['account_id']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('date', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('date', '<=', $filters['date_to']);
        }

        return $query->orderByDesc('date')->paginate($perPage);
    }

    public function createForUser(int $userId, array $data): Transaction
    {
        $data['user_id'] = $userId;
        return Transaction::create($data);
    }

    public function findUserTransaction(int $userId, int $transactionId): ?Transaction
    {
        return Transaction::query()
            ->where('user_id', $userId)
            ->with(['account', 'category'])
            ->find($transactionId);
    }

    public function deleteModel(Transaction $transaction): bool
    {
        return (bool) $transaction->delete();
    }

    public function getSummaryReport(int $userId, string $from, string $to): array
    {
        $result = Transaction::query()
            ->where('user_id', $userId)
            ->whereBetween('date', [$from, $to])
            ->selectRaw('type, SUM(amount) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        return [
            'income' => (float) ($result['credit'] ?? 0),
            'expense' => (float) ($result['debit'] ?? 0),
            'net' => (float) (($result['credit'] ?? 0) - ($result['debit'] ?? 0)),
        ];
    }

    public function getCategoryReport(int $userId, string $from, string $to): array
    {
        return Transaction::query()
            ->where('user_id', $userId)
            ->whereBetween('date', [$from, $to])
            ->with('category')
            ->selectRaw('category_id, type, SUM(amount) as total')
            ->groupBy('category_id', 'type')
            ->get()
            ->groupBy('category_id')
            ->map(function ($transactions) {
                $category = $transactions->first()->category;
                $income = $transactions->where('type', 'credit')->sum('total');
                $expense = $transactions->where('type', 'debit')->sum('total');
                
                return [
                    'category_id' => $category?->id,
                    'category_name' => $category?->name,
                    'income' => (float) $income,
                    'expense' => (float) $expense,
                    'net' => (float) ($income - $expense),
                ];
            })
            ->values()
            ->toArray();
    }
}