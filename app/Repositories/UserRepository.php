<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class UserRepository
{
    public function create(array $data): User
    {
        
        return User::create($data);
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function all(): Collection
    {
        return User::all();
    }
    
}