<?php

declare(strict_types=1);

namespace App\Services\ProfileService;

use App\DTO\Profile\UpdateProfileDTO;
use App\Models\Profile;
use Illuminate\Http\UploadedFile;

interface ProfileServiceContract
{
    public function update(UpdateProfileDTO $dto, int $userId): Profile;

    public function getByUserIdOrFail(int $userId): Profile;

    public function updateAvatar(UploadedFile $file, int $userId): Profile;

    public function deleteAvatar(int $userId): void;
}
