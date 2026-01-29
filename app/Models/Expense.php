<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'card_id',
        'name',
        'description',
        'amount',
        'due_date',
        'is_paid',
    ];
}
