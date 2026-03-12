<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\DTO\User\CreateUserDTO;
use App\Models\User;

final class EloquentUserRepository implements UserRepositoryContract
{
    public function getByEmailOrPhone(string $emailOrPhone): ?User
    {
        return User::query()->where('email', $emailOrPhone)->orWhere('phone', $emailOrPhone)->first();
    }

    public function getByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }

    public function getByPhone(string $phone): ?User
    {
        return User::query()->where('phone', $phone)->first();
    }

    public function create(CreateUserDTO $dto): User
    {
        return User::query()->create([
            'email' => $dto->email,
            'phone' => $dto->phone,
            'password' => $dto->password,
        ]);
    }

    public function delete(int $userId): void
    {
        User::query()->where('id', $userId)->delete();
    }
}
