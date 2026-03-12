<?php

declare(strict_types=1);

namespace App\Repositories\UserAction;

use App\DTO\UserAction\CreateUserActionDTO;
use App\Models\UserAction;
use Illuminate\Pagination\LengthAwarePaginator;

final class EloquentUserActionRepository implements UserActionRepositoryContract
{
    public function create(CreateUserActionDTO $dto): UserAction
    {
        return UserAction::query()->create([
            'user_id' => $dto->userId,
            'action' => $dto->userActionType,
            'details' => $dto->details,
        ]);
    }

    public function getPaginateByUserId(int $userId): LengthAwarePaginator
    {
        return UserAction::query()->where('user_id', $userId)->paginate(10);
    }
}
