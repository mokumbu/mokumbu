<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'name',
        'balance',
    ];
}
