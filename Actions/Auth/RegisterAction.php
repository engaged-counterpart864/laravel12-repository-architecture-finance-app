<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    /**
     * @param UserRepositoryInterface $users Repository for user persistence
     */
    public function __construct(private UserRepositoryInterface $users)
    {}

    /**
     * Create a new user.
     *
     * @param RegisterRequest $request Validated registration payload
     * @return void
     */
    public function handle(RegisterRequest $request): void
    {
        $this->users->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    }
}
