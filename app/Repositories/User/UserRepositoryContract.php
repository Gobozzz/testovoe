<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\DTO\User\CreateUserDTO;
use App\Models\User;

interface UserRepositoryContract
{
    public function getByEmailOrPhone(string $emailOrPhone): ?User;

    public function getByEmail(string $email): ?User;

    public function getByPhone(string $phone): ?User;

    public function create(CreateUserDTO $dto): User;

    public function delete(int $userId): void;
}
