<?php

declare(strict_types=1);

namespace App\Services\AuthService;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegisterDTO;
use App\DTO\Auth\SuccessAuthDTO;
use App\Models\User;

interface AuthServiceContract
{
    public function login(LoginDTO $dto): SuccessAuthDTO;

    public function register(RegisterDTO $dto): SuccessAuthDTO;

    public function logout(User $user): void;
}
