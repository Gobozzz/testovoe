<?php

declare(strict_types=1);

namespace App\Services\AuthService;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegisterDTO;
use App\DTO\Auth\SuccessAuthDTO;
use App\DTO\User\CreateUserDTO;
use App\Exceptions\Auth\EmailBusyException;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Exceptions\Auth\PhoneBusyException;
use App\Models\User;
use App\Repositories\Profile\ProfileRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class AuthService implements AuthServiceContract
{
    private const NAME_ACCESS_TOKEN = 'auth_token';

    public function __construct(
        private readonly UserRepositoryContract $userRepository,
        private readonly ProfileRepositoryContract $profileRepository,
    ) {}

    public function login(LoginDTO $dto): SuccessAuthDTO
    {
        $userByLogin = $this->userRepository->getByEmailOrPhone($dto->login);
        if ($userByLogin && Hash::check($dto->password, $userByLogin->password)) {
            return new SuccessAuthDTO(
                token: $userByLogin->createToken(self::NAME_ACCESS_TOKEN)->plainTextToken,
                expiresTime: $this->getExpiresMinutesForToken(),
                userId: $userByLogin->getKey(),
            );
        }
        throw new InvalidCredentialsException;
    }

    public function register(RegisterDTO $dto): SuccessAuthDTO
    {
        $userByEmail = $this->userRepository->getByEmail($dto->email);

        if ($userByEmail) {
            throw new EmailBusyException;
        }

        $userByPhone = $this->userRepository->getByPhone($dto->phone);

        if ($userByPhone) {
            throw new PhoneBusyException;
        }

        // Транзакция обеспечит согласованость данных в БД
        // То есть не будет ситуаций, что пользователь создан, а профиля у него нет.
        return DB::transaction(function () use ($dto) {
            $userCreated = $this->userRepository->create(new CreateUserDTO(
                email: $dto->email,
                phone: $dto->phone,
                password: Hash::make($dto->password),
            ));

            $this->profileRepository->create($userCreated->getKey());

            return new SuccessAuthDTO(
                token: $userCreated->createToken(self::NAME_ACCESS_TOKEN)->plainTextToken,
                expiresTime: $this->getExpiresMinutesForToken(),
                userId: $userCreated->getKey(),
            );
        });
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    private function getExpiresMinutesForToken(): int
    {
        return config('sanctum.expiration');
    }
}
