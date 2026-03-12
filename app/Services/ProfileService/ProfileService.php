<?php

declare(strict_types=1);

namespace App\Services\ProfileService;

use App\DTO\Profile\UpdateProfileDTO;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class ProfileService implements ProfileServiceContract
{
    public function getByUserIdOrFail(int $userId): Profile
    {
        return Profile::query()->where('user_id', $userId)->first();
    }

    public function update(UpdateProfileDTO $dto, int $userId): Profile
    {
        $profile = $this->getByUserIdOrFail($userId);

        $profile->first_name = $dto->firstName;
        $profile->last_name = $dto->lastName;
        $profile->saveOrFail();

        return $profile;
    }

    public function updateAvatar(UploadedFile $file, int $userId): Profile
    {
        $profile = $this->getByUserIdOrFail($userId);

        $this->deleteAvatar($userId);

        $pathToAvatar = $this->uploadAvatarFile($file);

        $profile->avatar = $pathToAvatar;
        $profile->saveOrFail();

        return $profile;
    }

    public function deleteAvatar(int $userId): void
    {
        $profile = $this->getByUserIdOrFail($userId);

        if ($profile->avatar) {
            Storage::delete($profile->avatar);
        }

        $profile->avatar = null;

        $profile->saveOrFail();
    }

    private function uploadAvatarFile(UploadedFile $file): string
    {
        return Storage::putFileAs(
            path: 'avatars/'.Carbon::now()->format('Y-m'),
            file: $file,
            name: uniqid().'.'.$file->getClientOriginalExtension()
        );
    }
}
