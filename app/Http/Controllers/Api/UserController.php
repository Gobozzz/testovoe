<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use App\Http\Resources\Api\UserAction\UserActionResource;
use App\Repositories\UserAction\UserActionRepositoryContract;
use App\Services\UserService\UserServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

final class UserController extends Controller
{
    public function __construct(
        private readonly UserServiceContract $userService,
        private readonly UserActionRepositoryContract $userActionRepository,
    ) {}

    public function get(Request $request)
    {
        return new UserResource($request->user());
    }

    public function getActions(Request $request): AnonymousResourceCollection
    {
        return UserActionResource::collection($this->userActionRepository->getPaginateByUserId($request->user()->getKey()));
    }

    public function delete(Request $request): Response
    {
        $this->userService->delete($request->user()->getKey());

        return response()->noContent();
    }
}
