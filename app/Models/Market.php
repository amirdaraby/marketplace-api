<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Market extends Model
{
    use HasFactory;

    protected $table = 'markets';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function location(): MorphOne
    {
        return $this->morphOne(Location::class, 'locational');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
