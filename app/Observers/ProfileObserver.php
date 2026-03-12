<?php

declare(strict_types=1);

namespace App\Observers;

use App\DTO\UserAction\CreateUserActionDTO;
use App\Enums\UserActionType;
use App\Models\Profile;
use App\Repositories\UserAction\UserActionRepositoryContract;

final class ProfileObserver
{
    public function __construct(
        private readonly UserActionRepositoryContract $userActionRepository
    ) {}

    public function updated(Profile $profile): void
    {
        $this->userActionRepository->create(new CreateUserActionDTO(
            userId: $profile->user_id,
            userActionType: UserActionType::PROFILE_UPDATED,
            details: ['user_id' => $profile->user_id, ...$profile->getChanges()],
        ));
    }
}
