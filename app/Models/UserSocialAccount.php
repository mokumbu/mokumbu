<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserSocialAccount extends Model
{
    use HasUuids;

    protected $fillable = [ 'user_id', 'provider', 'provider_uid', 'provider_email' ];
}
