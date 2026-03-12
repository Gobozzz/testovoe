<?php

declare(strict_types=1);

namespace App\Services\UserActionService;

use App\DTO\UserAction\CreateUserActionDTO;
use App\Models\UserAction;

interface UserActionServiceContract
{
    public function create(CreateUserActionDTO $dto): UserAction;
}
