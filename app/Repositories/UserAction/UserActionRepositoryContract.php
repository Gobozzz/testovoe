<?php

declare(strict_types=1);

namespace App\Repositories\UserAction;

use App\DTO\UserAction\CreateUserActionDTO;
use App\Models\UserAction;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserActionRepositoryContract
{
    public function create(CreateUserActionDTO $dto): UserAction;

    public function getPaginateByUserId(int $userId): LengthAwarePaginator;
}
