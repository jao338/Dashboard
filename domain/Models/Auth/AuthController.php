<?php

namespace Domain\Models\Auth;

use App\Http\Controllers\Controller;
use Domain\Models\Auth\Requests\AuthLoginRequest;
use Domain\Models\Auth\Resources\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller {

    public function login(AuthLoginRequest $request, AuthService $service): JsonResource
    {
        return new AuthResource($service->login($request->all()));
    }

    public function logout(Request $request, AuthService $service): JsonResponse
    {
        $service->logout($request);

        return response()->json(['message' => __('messages.success_logout')]);
    }

    public function me(): JsonResource
    {
        return new AuthResource(auth()->user());
    }
}
