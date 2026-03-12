<?php

declare(strict_types=1);

namespace App\Observers;

use App\DTO\UserAction\CreateUserActionDTO;
use App\Enums\UserActionType;
use App\Models\User;
use App\Repositories\UserAction\UserActionRepositoryContract;

final class UserObserver
{
    public function __construct(
        private readonly UserActionRepositoryContract $userActionRepository,
    ) {}

    public function created(User $user): void
    {
        $this->userActionRepository->create(new CreateUserActionDTO(
            userId: $user->getKey(),
            userActionType: UserActionType::CREATED,
            details: ['user_id' => $user->getKey(), 'email' => $user->email, 'phone' => $user->phone],
        ));
    }

    public function updated(User $user): void
    {
        $this->userActionRepository->create(new CreateUserActionDTO(
            userId: $user->getKey(),
            userActionType: UserActionType::UPDATED,
            details: ['user_id' => $user->getKey(), ...$user->getChanges()],
        ));
    }

    public function deleted(User $user): void
    {
        $this->userActionRepository->create(new CreateUserActionDTO(
            userId: $user->getKey(),
            userActionType: UserActionType::DELETED,
            details: ['user_id' => $user->getKey(), 'date' => now()],
        ));
    }
}
