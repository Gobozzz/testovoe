<?php

declare(strict_types=1);

namespace App\Repositories\Profile;

use App\Models\Profile;

final class EloquentProfileRepository implements ProfileRepositoryContract
{
    public function create(int $userId): Profile
    {
        return Profile::query()->create(['user_id' => $userId]);
    }
}
