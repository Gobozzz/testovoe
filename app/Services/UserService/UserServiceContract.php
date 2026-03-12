<?php

declare(strict_types=1);

namespace App\Services\UserService;

interface UserServiceContract
{
    public function delete(int $userId): void;
}
