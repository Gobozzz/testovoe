<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Auth;

use App\DTO\Auth\LoginDTO;
use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function getDTO(): LoginDTO
    {
        return new LoginDTO(
            login: $this->get('login'),
            password: $this->get('password'),
        );
    }
}
