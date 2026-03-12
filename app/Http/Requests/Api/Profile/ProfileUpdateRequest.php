<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Profile;

use App\DTO\Profile\UpdateProfileDTO;
use Illuminate\Foundation\Http\FormRequest;

final class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
        ];
    }

    public function getDTO(): UpdateProfileDTO
    {
        return new UpdateProfileDTO(
            firstName: $this->get('first_name'),
            lastName: $this->get('last_name'),
        );
    }
}
