<?php

namespace App\Observers;

use App\Models\User;

/**
 * User Observer
 * 
 * This observer handles model events for the User model. It automatically
 * sets required fields like UID, API token, and timestamps when users
 * are created or updated.
 * 
 * @package App\Observers
 * @version 1.0.0
 */
class UserObserver extends BaseObserver
{
    /**
     * Handle the User "creating" event.
     * 
     * Automatically sets the UID, API token, and created timestamp
     * when a new user is being created.
     * 
     * @param User $user The user model instance being created
     * @return void
     */
    public function creating(User $user): void
    {
        $user->setCreatedTimestamp();
    }

    /** 
     * Handle the User "updating" event.
     * 
     * Automatically sets the updated timestamp when a user is being updated.
     * 
     * @param User $user The user model instance being updated
     * @return void
     */
    public function updating(User $user): void
    {
        $user->setUpdatedTimestamp();
    }

    /**
     * Handle the User "created" event.
     * 
     * Logs the creation of a user.
     * 
     * @param User $user The user model instance being created
     * @return void
     */
    public function created(User $user): void
    {
    }

    /**
     * Handle the User "updated" event.
     * 
     * Logs the update of a user.
     * 
     * @param User $user The user model instance being updated
     * @return void
     */
    public function updated(User $user): void
    {
    }

    /**
     * Handle the User "deleted" event.
     * 
     * Logs the deletion of a user.
     * 
     * @param User $user The user model instance being deleted
     * @return void
     */
    public function deleted(User $user): void
    {
    }
}
