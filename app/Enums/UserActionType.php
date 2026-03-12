<?php

declare(strict_types=1);

namespace App\Enums;

enum UserActionType: string
{
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';
    case PROFILE_UPDATED = 'profile_updated';
}
