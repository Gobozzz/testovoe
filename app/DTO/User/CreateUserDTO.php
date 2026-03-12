<?php

declare(strict_types=1);

namespace App\DTO\User;

final readonly class CreateUserDTO
{
    public function __construct(
        public string $email,
        public string $phone,
        public string $password,
    ) {}
}
