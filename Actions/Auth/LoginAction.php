<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginAction
{
    /**
     * @param UserRepositoryInterface $users Repository for user retrieval
     */
    public function __construct(private UserRepositoryInterface $users)
    {}

    /**
     * Validate credentials and return JWT token.
     *
     * @param LoginRequest $request Validated login payload
     * @return array{token:string, token_type:string, user:\App\Models\User}|array{error:string}
     */
    public function handle(LoginRequest $request): array
    {
        $credentials = $request->only('email', 'password');
        
        if (!$token = JWTAuth::attempt($credentials)) {
            return ['error' => 'Invalid credentials'];
        }

        $user = Auth::user();
        return [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ];
    }
}
