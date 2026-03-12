<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\Api\Auth\SuccessAuthResource;
use App\Services\AuthService\AuthServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class AuthController extends Controller
{
    public function __construct(
        private readonly AuthServiceContract $authService
    ) {}

    public function login(LoginRequest $request): SuccessAuthResource
    {
        $authDTO = $this->authService->login($request->getDTO());

        return new SuccessAuthResource($authDTO);
    }

    public function register(RegisterRequest $request): SuccessAuthResource
    {
        $authDTO = $this->authService->register($request->getDTO());

        return new SuccessAuthResource($authDTO);
    }

    public function logout(Request $request): Response
    {
        $this->authService->logout($request->user());

        return response()->noContent();
    }
}
