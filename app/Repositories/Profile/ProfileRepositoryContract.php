<?php

declare(strict_types=1);

namespace App\Repositories\Profile;

use App\Models\Profile;

interface ProfileRepositoryContract
{
    public function create(int $userId): Profile;
}
