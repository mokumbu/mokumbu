<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'bank_id',
        'name',
        'description',
        'balance',
        'expires_at',
        'is_active',
        'is_frozen',
    ];
}
