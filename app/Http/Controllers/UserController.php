<?php
namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $user = auth()->user();
        $this->userService->updateUser($user, $request->validated());
        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function destroy($id): JsonResponse
    {
        $user = auth()->user();
        $this->userService->deleteUser($user);
        return response()->json(['message' => 'User deleted successfully']);
    }
}