<?php

namespace App\Services\Auth;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $data)
    {
        $user = $this->userRepository->first(['email' => $data['email']]);
        
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return [
            'user' => $user,
            'access_token' => $user->createToken(
                'access_token',
                ['access-api'],
                now()->addMinutes(config('sanctum.access_token_exp')
            ))->plainTextToken,
            'refresh_token' => $user->createToken(
                'refresh_token',
                ['access-token'],
                now()->addDays(config('sanctum.refresh_token_exp'))
            )->plainTextToken,
        ];
    }
}
