<?php

declare(strict_types=1);

namespace App\DTO\UserAction;

use App\Enums\UserActionType;

final readonly class CreateUserActionDTO
{
    public function __construct(
        public int $userId,
        public UserActionType $userActionType,
        public ?array $details = null,
    ) {}
}
