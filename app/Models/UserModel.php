<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'auth';
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role'
    ];

}
