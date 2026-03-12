<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use App\Exceptions\BaseException;

final class PhoneBusyException extends BaseException
{
    public function __construct()
    {
        parent::__construct(
            'Phone busy',
            'auth.phone_busy',
        );
    }
}
