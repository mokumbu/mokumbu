<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DebtorTransaction extends Model
{
    use HasUuids;

    protected $fillable = [
        'debtor_id',
        'amount',
        'balance_before',
        'balance_after',
        'description',
    ];
}
