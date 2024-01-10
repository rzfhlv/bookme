<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;    
    }

    public function create(array $data)
    {
        return $this->user::create($data);
    }

    public function first(array $data)
    {
        return $this->user::where($data)->first();
    }
}