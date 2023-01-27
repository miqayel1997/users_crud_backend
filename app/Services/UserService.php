<?php

namespace App\Services;

use App\Dto\CreateUserDto;
use App\Dto\UpdateUserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function list(): Collection
    {
        return User::query()->get();
    }

    public function get(int $id): User
    {
        return User::query()->find($id);
    }

    public function create(CreateUserDto $request): int
    {
        $user = User::query()->create([
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return $user->id;
    }

    public function update(UpdateUserDto $request): void
    {
        User::query()->where('id', '=', $request->id)->update([
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
    }

    public function delete(int $id): void
    {
        User::query()->where('id', '=', $id)->delete();
    }
}
