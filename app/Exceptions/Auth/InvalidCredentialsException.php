<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;

final class InvalidCredentialsException extends BaseException
{
    public function __construct()
    {
        parent::__construct(
            'Invalid credentials.',
            'auth.invalid_credentials',
        );
    }
}
