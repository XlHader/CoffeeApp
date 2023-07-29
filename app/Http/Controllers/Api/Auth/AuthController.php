<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {
    }

    /**
     * Login
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse {
        $credentials = $request->only(['email', 'password']);
        return $this->authService->login($credentials);
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse {
        $credentials = $request->only(['name', 'email', 'password']);
        return $this->authService->register($credentials);
    }

    public function logout(): \Illuminate\Http\JsonResponse {
        return $this->authService->logout();
    }

    public function refresh(): \Illuminate\Http\JsonResponse {
        return $this->authService->refresh();
    }
}
