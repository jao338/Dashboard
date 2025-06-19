<?php

namespace Domain\Models\Auth;

use Domain\Models\User\User;
use Illuminate\Http\Request;

class AuthService
{
    public function __construct(protected AuthRepository $repository) {

    }

    public function login(?array $data = null): User
    {
        return $this->repository->login($data);
    }
    public function logout(Request $request): void
    {
        $this->repository->logout($request);
    }
}
