<?php

namespace App\Services;

use App\Exceptions\AuthException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService {
    public function login(array $credentials) {
        try {
            $token = Auth::attempt($credentials);

            if (!$token) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            $user = JWTAuth::user();

            return response()->json([
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'Bearer'
                ]
            ]);
        } catch (\Exception $e) {
            throw new AuthException($e, "Error while login", 401);
        }
    }

    public function register(array $credentials) {
        try {
            $user = User::create($credentials);
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'Bearer'
                ]
            ]);
        } catch (\Exception $e) {
            throw new AuthException($e, "Error while register", 401);
        }
    }

    public function refresh() {
        try {
            $token = JWTAuth::refresh(JWTAuth::getToken());
            $user = JWTAuth::user();

            return response()->json([
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'Bearer'
                ]
            ]);
        } catch (\Exception $e) {
            throw new AuthException($e, "Error while refresh token", 401);
        }
    }

    public function logout() {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Logout success'
            ]);
        } catch (\Exception $e) {
            throw new AuthException($e, "Error while logout", 401);
        }
    }

    public function me() {
        try {
            $user = JWTAuth::user();

            return response()->json([
                'user' => $user
            ]);
        } catch (\Exception $e) {
            throw new AuthException($e, "Error while verify token", 401);
        }
    }
}
