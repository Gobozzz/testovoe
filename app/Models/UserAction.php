<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserActionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class UserAction extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'details',
    ];

    protected $casts = [
        'action' => UserActionType::class,
        'details' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
