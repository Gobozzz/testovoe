<?php

declare(strict_types=1);

namespace App\DTO\Profile;

final readonly class UpdateProfileDTO
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $lastName = null,
    ) {}
}
