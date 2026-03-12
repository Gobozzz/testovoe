<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Profile\EloquentProfileRepository;
use App\Repositories\Profile\ProfileRepositoryContract;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\User\UserRepositoryContract;
use App\Services\AuthService\AuthService;
use App\Services\AuthService\AuthServiceContract;
use App\Services\ProfileService\ProfileService;
use App\Services\ProfileService\ProfileServiceContract;
use App\Services\UserActionService\UserActionService;
use App\Services\UserActionService\UserActionServiceContract;
use App\Services\UserService\UserService;
use App\Services\UserService\UserServiceContract;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Services
        $this->app->bind(AuthServiceContract::class, AuthService::class);
        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(ProfileServiceContract::class, ProfileService::class);
        $this->app->bind(UserActionServiceContract::class, UserActionService::class);

        // Repositories
        $this->app->bind(ProfileRepositoryContract::class, EloquentProfileRepository::class);
        $this->app->bind(UserRepositoryContract::class, EloquentUserRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
