<?php

declare(strict_types=1);

namespace App\DTO\Auth;

final readonly class SuccessAuthDTO
{
    public function __construct(
        public string $token,
        public int $expiresTime,
        public int $userId,
    ) {}
}
