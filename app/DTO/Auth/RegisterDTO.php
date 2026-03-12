<?php

declare(strict_types=1);

namespace App\DTO\Auth;

final readonly class RegisterDTO
{
    public function __construct(
        public string $email,
        public string $phone,
        public string $password
    ) {}
}
