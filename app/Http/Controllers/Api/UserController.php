<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\UserResource;
use App\Services\UserService\UserServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class UserController extends Controller
{
    public function __construct(
        private readonly UserServiceContract $userService,
    ) {}

    public function get(Request $request)
    {
        return new UserResource($request->user());
    }

    public function delete(Request $request): Response
    {
        $this->userService->delete($request->user()->getKey());

        return response()->noContent();
    }
}
