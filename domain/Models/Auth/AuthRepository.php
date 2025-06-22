<?php

namespace Domain\Models\Auth;

use Domain\Base\Exceptions\DashboardException;
use Domain\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function __construct(protected User $model) { }

    public function login(array $data): User
    {
        $email = $data['email'];
        $password = $data['password'];

        $user = User::where('email', $email)->first();

        throw_if(!$user || !Hash::check($password, $user->password), new DashboardException(__('messages.invalid_login')));

        Auth::login($user);

        $this->setToken($user);

        return $user;
    }

    public function logout(Request $request): void
    {
        if ($request->bearerToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        if ($request->hasSession()) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
    }

    private function setToken(User $user): void
    {
        if (!requestFromFrontend()) {
            $token = $user->createToken('token-api')->plainTextToken;

            $user->setActiveToken($token);
        }
    }
}
