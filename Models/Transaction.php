<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Transaction Model
 * 
 * Represents financial transactions (debit/credit) with account and category associations
 */
class Transaction extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'user_id',
        'type',
        'amount',
        'date',
        'description',
        'category_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'datetime',
    ];

    /**
     * Get the user that owns the transaction
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the account associated with the transaction
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the category associated with the transaction
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}