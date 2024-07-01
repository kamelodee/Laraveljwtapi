<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        event(new UserRegistered($user));

        return $user;
    }

    public function updateUser(User $user, array $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(User $user)   {
        return $this->userRepository->delete($user);
    }

   
    public function findByEmail($email)   {
        return $this->userRepository->findByEmail($email);
    }
}
