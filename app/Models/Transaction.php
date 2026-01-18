<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'card_id',
        'expense_id',
        'category_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'description',
        'transaction_date',
    ];
}
