<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAccessToken extends Model
{

    protected $table = 'user_access_tokens';

    protected $fillable = [
        "token",
        "user_id",
        "token",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
