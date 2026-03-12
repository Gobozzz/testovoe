<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;

final class EmailBusyException extends BaseException
{
    public function __construct()
    {
        parent::__construct(
            'Email busy',
            'auth.email_busy',
        );
    }
}
