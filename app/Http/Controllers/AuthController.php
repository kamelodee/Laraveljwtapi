<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Events\UserLoggedIn;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterUserRequest $request): JsonResponse

    {
        $existingUser = $this->userService->findByEmail($request->email);
        if ($existingUser) {
            return response()->json(['error' => 'User with this email already exists'], 409);
        }

        $user = $this->userService->createUser($request->validated());
       
        $token = auth()->login($user);

        // event(new UserLoggedIn($user));
        return response()->json(["status"=>200,'user' => $user,"token"=> $this->respondWithToken($token)], 200);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
       
        return $this->respondWithToken($token);
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}