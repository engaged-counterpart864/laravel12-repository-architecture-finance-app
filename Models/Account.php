<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'balance',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the account.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


