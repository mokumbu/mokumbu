<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasUuids;

    protected $fillable = [ 'user_id', 'profile_picture', 'phone_number', 'birthdate', 'gender', 'address' ];
}
