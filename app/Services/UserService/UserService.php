<?php

declare(strict_types=1);

namespace App\Services\UserService;

use App\Repositories\User\UserRepositoryContract;

final class UserService implements UserServiceContract
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    ) {}

    public function delete(int $userId): void
    {
        $this->userRepository->delete($userId);
    }
}
