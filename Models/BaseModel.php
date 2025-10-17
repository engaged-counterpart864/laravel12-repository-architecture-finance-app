<?php

namespace App\Models;

use App\Traits\HasUid;
use App\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasTimestamps;

    /**
     * Bootstrap any application services.
     */
    public static function boot()
    {
        parent::boot();

        // Auto-generate UID when creating models that have the uid property
        static::creating(function ($item) {
            // Set created_at timestamp
            $item->setCreatedTimestamp();
        });

        // Update updated_at when updating models
        static::updating(function ($item) {
            $item->setUpdatedTimestamp();
        });

        // Log the creation of a model
        static::created(function ($item) {
        });

        // Log the update of a model
        static::updated(function ($item) {
        });

        // Log the deletion of a model
        static::deleted(function ($item) {
        });
    }
}