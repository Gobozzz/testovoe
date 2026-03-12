<?php

declare(strict_types=1);

namespace App\Services\UserActionService;

use App\DTO\UserAction\CreateUserActionDTO;
use App\Models\UserAction;

final class UserActionService implements UserActionServiceContract
{
    public function create(CreateUserActionDTO $dto): UserAction
    {
        return UserAction::query()->create([
            'user_id' => $dto->userId,
            'action' => $dto->userActionType,
            'details' => $dto->details,
        ]);
    }
}
