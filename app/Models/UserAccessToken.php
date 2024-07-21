<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class UserAccessToken extends Model
{

    protected $table = 'user_access_tokens';

    public $timestamps = false;

    protected $fillable = [
        "token",
        "user_id",
        "token",
    ];

    public function generateToken()
    {
        return hash('sha256', Str::random(60));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
