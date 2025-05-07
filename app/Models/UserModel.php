<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'auth';
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role'
    ];

}
