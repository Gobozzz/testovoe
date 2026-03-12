<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\UserAction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserActionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'user_id' => $this->user_id,
            'action' => $this->action->value,
            'details' => $this->details,
        ];
    }
}
