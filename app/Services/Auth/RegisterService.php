<?php

namespace App\Services\Auth;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $user = $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return [
            'user' => $user,
            'access_token' => $user->createToken(
                'access_token',
                ['access-api'],
                now()->addMinutes(config('sanctum.access_token_exp'))
            )->plainTextToken,
            'refresh_token' => $user->createToken(
                'refresh_token',
                ['access-token'],
                now()->addDays(config('sanctum.refresh_token_exp'))
            )->plainTextToken,
        ];
    }
}
