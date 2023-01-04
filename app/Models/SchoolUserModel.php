<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SchoolUserModel extends Authenticatable
{
    use HasFactory;
    protected $table      = 'school_users';
    protected $primaryKey = 'user_id';
    protected $fillable   =
        [
            'user_id',
            'school_admin_id',
            'user_name',
            'user_role',
            'user_email',
            'password'
        ];
}
