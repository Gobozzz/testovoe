<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Profile\ProfileUpdateAvatarRequest;
use App\Http\Requests\Api\Profile\ProfileUpdateRequest;
use App\Http\Resources\Api\Profile\ProfileResource;
use App\Services\ProfileService\ProfileServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileServiceContract $profileService,
    ) {}

    public function update(ProfileUpdateRequest $request)
    {
        $profileUpdated = $this->profileService->update($request->getDTO(), $request->user()->getKey());

        return new ProfileResource($profileUpdated);
    }

    public function get(Request $request): ProfileResource
    {
        return new ProfileResource($request->user()->profile);
    }

    public function updateAvatar(ProfileUpdateAvatarRequest $request): ProfileResource
    {
        $profile = $this->profileService->updateAvatar($request->file('file'), $request->user()->getKey());

        return new ProfileResource($profile);
    }

    public function deleteAvatar(Request $request): Response
    {
        $this->profileService->deleteAvatar($request->user()->getKey());

        return response()->noContent();
    }
}
